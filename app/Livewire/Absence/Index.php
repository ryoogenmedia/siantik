<?php

namespace App\Livewire\Absence;

use App\Models\Attendance;
use App\Models\Institution;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $userId;

    public $longitude;
    public $latitude;

    public $distance;
    public $inRadius = false;

    public $instLongitude;
    public $instLatitude;
    public $radius;

    public $checkAbsence = true;
    public $isCheckOut = false;
    public $isPermit = false;

    #[On('location')]
    public function getLocationAttendance($latitude, $longitude, $distance)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->distance = $distance;

        $this->inRadius = $distance <= $this->radius;
    }

    #[On('takePicture')]
    public function attendanceNow($base_64)
    {
        if (!$this->inRadius) {
            session()->flash('alert', [
                'type' => 'warning',
                'message' => 'Bahaya.',
                'detail' => "Anda berada di luar jangkauan radius presensi.",
            ]);
            return;
        }

        if (preg_match('/^data:image\/(\w+);base64,/', $base_64, $type)) {
            $data = substr($base_64, strpos($base_64, ',') + 1);
            $data = str_replace(' ', '+', $data);
            $data = base64_decode($data);

            if ($data === false) {
                throw new \Exception('Decoding base64 failed');
            }

            $extension = strtolower($type[1]);
            $fileName = uniqid() . '.' . $extension;
            $filePath = 'public/attendance-picture/' . $fileName;
            Storage::put($filePath, $data);
            $fileUrl = Storage::url('attendance-picture/' . $fileName);

            $user = User::findOrFail($this->userId);
            $absence = Attendance::query()
                ->where('user_id', $user->id)
                ->whereDate('created_at', now()->toDateString())
                ->first();

            $permit = Permission::query()
                ->where('user_id', $user->id)
                ->whereDate('created_at', now()->toDateString())
                ->first();

            $this->isPermit = $permit ? true : false;

            if ($absence && $absence->check_out || $permit) {
                $this->checkAbsence = false;

                session()->flash('alert', [
                    'type' => 'warning',
                    'message' => 'Bahaya.',
                    'detail' => "Anda hanya dapat melakukan presensi sekali dalam sehari.",
                ]);

                return redirect()->back();
            }

            if (!$this->instLatitude || !$this->instLongitude) {
                session()->flash('alert', [
                    'type' => 'warning',
                    'message' => 'Bahaya.',
                    'detail' => "Admin belum mengaktifkan lokasi instansi. Anda tidak bisa presensi sekarang.",
                ]);

                return back();
            }

            $status = 'hadir';

            $attendance = Attendance::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'check_in' => now()->format('d-m-Y H:i:s'),
                'longitude' => $this->longitude,
                'latitude' => $this->latitude,
                'image' => $fileUrl,
                'status_attendance' => $status,
            ]);

            session()->flash('alert', [
                'type' => 'success',
                'message' => 'Berhasil.',
                'detail' => "Anda sekarang telah hadir.",
            ]);

            return redirect()->route('absence.index');
        } else {
            throw new \Exception('Invalid base64 string');
        }
    }

    public function absenceCheckOut()
    {
        $absence = Attendance::query()
            ->where('user_id', $this->userId)
            ->whereDate('created_at', now()->toDateString())
            ->first();

        $absence->update([
            'check_out' => now()->format('d-m-Y H:i:s'),
        ]);

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => "Anda telah melakukan presensi pulang.",
        ]);

        return redirect()->back();
    }

    public function mount()
    {
        $institution = Institution::first();

        $user = User::findOrFail(auth()->user()->id);
        $this->userId = $user->id;

        $absence = Attendance::query()
            ->where('user_id', $user->id)
            ->whereDate('created_at', now()->toDateString())
            ->first();

        $permit = Permission::query()
            ->where('user_id', $user->id)
            ->whereDate('created_at', now()->toDateString())
            ->first();

        if ($absence || $permit) {
            $this->checkAbsence = false;
        }

        $isCheckOut = Institution::query()
            ->where('time_check_out', '<=', now()->format('H:i:s'))
            ->first();

        if ($isCheckOut) {
            $this->isCheckOut = !isset($absence->check_out);
        }

        if ($institution) {
            $this->instLatitude = $institution->latitude;
            $this->instLongitude = $institution->longitude;
            $this->radius = $institution->radius;
        }
    }

    public function render()
    {
        return view('livewire.absence.index');
    }
}
