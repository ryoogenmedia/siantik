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
    public $longitude, $latitude, $distance;
    public $inRadius = false;
    public $instLongitude, $instLatitude, $radius;
    public $checkAbsence = true, $isCheckOut = false, $isPermit = false;

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
            $data = base64_decode(substr($base_64, strpos($base_64, ',') + 1));

            if ($data === false) {
                throw new \Exception('Decoding base64 failed');
            }

            $fileName = uniqid() . '.' . strtolower($type[1]);
            $filePath = 'public/attendance-picture/' . $fileName;
            Storage::put($filePath, $data);
            $fileUrl = Storage::url('attendance-picture/' . $fileName);

            $user = User::findOrFail($this->userId);
            $absence = Attendance::where('user_id', $user->id)
                ->whereDate('created_at', now()->toDateString())
                ->first();

            $permit = Permission::where('user_id', $user->id)
                ->whereDate('created_at', now()->toDateString())
                ->exists();

            $this->isPermit = $permit;

            if ($absence || $permit) {
                $this->checkAbsence = false;
                session()->flash('alert', [
                    'type' => 'warning',
                    'message' => 'Presensi sudah dilakukan.',
                    'detail' => "Anda hanya dapat melakukan presensi sekali dalam sehari.",
                ]);
                return redirect()->back();
            }

            if (!$this->instLatitude || !$this->instLongitude) {
                session()->flash('alert', [
                    'type' => 'warning',
                    'message' => 'Lokasi tidak aktif.',
                    'detail' => "Admin belum mengaktifkan lokasi instansi.",
                ]);
                return back();
            }

            Attendance::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'check_in' => now()->format('Y-m-d H:i:s'),
                'longitude' => $this->longitude,
                'latitude' => $this->latitude,
                'image' => $fileUrl,
                'status_attendance' => 'hadir',
            ]);

            session()->flash('alert', [
                'type' => 'success',
                'message' => 'Berhasil!',
                'detail' => "Anda telah berhasil presensi.",
            ]);

            return redirect()->route('absence.index');
        } else {
            throw new \Exception('Invalid base64 string');
        }
    }

    public function absenceCheckOut()
    {
        $absence = Attendance::where('user_id', $this->userId)
            ->whereDate('created_at', now()->toDateString())
            ->first();

        if ($absence) {
            $absence->update([
                'check_out' => now()->format('Y-m-d H:i:s'),
            ]);

            session()->flash('alert', [
                'type' => 'success',
                'message' => 'Presensi Pulang Berhasil.',
                'detail' => "Anda telah melakukan presensi pulang.",
            ]);
        }

        return redirect()->back();
    }

    public function mount()
    {
        $institution = Institution::first();
        $user = auth()->user();
        $this->userId = $user->id;

        $absence = Attendance::where('user_id', $user->id)
            ->whereDate('created_at', now()->toDateString())
            ->first();

        $this->isPermit = Permission::where('user_id', $user->id)
            ->whereDate('created_at', now()->toDateString())
            ->exists();

        if ($absence || $this->isPermit) {
            $this->checkAbsence = false;
        }

        $this->isCheckOut = now()->format('H:i:s') >= optional($institution)->time_check_out_end;

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
