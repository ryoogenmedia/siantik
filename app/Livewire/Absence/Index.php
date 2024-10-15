<?php

namespace App\Livewire\Absence;

use App\Models\Attendance;
use App\Models\Institution;
use App\Models\Permission;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $userId;

    public $longitude;
    public $latitude;

    public $distance;

    public $instLongitude;
    public $instLatitude;
    public $radius;

    public $checkAbsence = true;
    public $isCheckOut = false;
    public $isPermit = false;

    #[On('location')]
    public function getLocationAttendace($latitude, $longitude, $distance){
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->distance = $distance;
    }

    #[On('takePicture')]
    public function attendanceNow($base_64){
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
            ->where('created_at', '<=', now()->endOfDay())
            ->first();
            
        $permit = Permission::query()
            ->where('user_id', $user->id)
            ->whereDate('created_at', now()->toDateString())
            ->where('created_at', '<=', now()->endOfDay())
            ->first();

        $this->isPermit = $permit ? true : false;

        if($absence || $permit){
            $this->checkAbsence = false; 

            session()->flash('alert', [
                'type' => 'warning',
                'message' => 'Bahaya.',
                'detail' => "anda hanya dapat sekali dalam sehari melakukan absensi.",
            ]);

            return redirect()->back();
        }

        if(!$this->instLatitude && !$this->instLongitude){
            session()->flash('alert', [
                'type' => 'warning',
                'message' => 'Bahaya.',
                'detail' => "admin belum meng-aktifkan lokasi instansi, anda tidak bisa absen sekarang.",
            ]);

            return back();
        }

        if(!$this->longitude || !$this->latitude || is_null($this->distance)){
            session()->flash('alert', [
                'type' => 'warning',
                'message' => 'Bahaya.',
                'detail' => "aktifkan lokasi anda sekarang, untuk melakukan absensi.",
            ]);

            return back();
        }

        $institution = Institution::first();

        $attendance = Attendance::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'check_in' => now()->format('d-m-Y H:i:s'),
            'image' => $fileUrl,
        ]);

        if ($this->distance == 0) {
            $status = now()->greaterThanOrEqualTo($institution->time_check_in) && now()->lessThanOrEqualTo($institution->time_check_out)
                ? 'terlambat'
                : (now()->greaterThan($institution->time_check_out) ? 'terlambat' : 'hadir');

            $attendance->update([
                'status_attendance' => $status,
            ]);
        } else {
            session()->flash('alert', [
                'type' => 'warning',
                'message' => 'Bahaya.',
                'detail' => "anda berada di luar jangkauan radius absensi.",
            ]);

            return redirect()->route('absence.index');
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => "anda sekarang telah hadir.",
        ]);

        return redirect()->back();

        }else {
            throw new \Exception('Invalid base64 string');
        }
    }

    public function absenceCheckOut(){
        $absence = Attendance::query()
            ->where('user_id', $this->userId)
            ->whereDate('created_at', now()->toDateString())
            ->where('created_at', '<=', now()->endOfDay())
            ->first();
            
        $absence->update([
            'check_out' => now()->format('d-m-Y H:i:s'),
        ]);
        
        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => "anda telah melakukan absensi pulang (siang)",
        ]);

        return redirect()->back();
    }

    public function mount(){
        $institution = Institution::first();

        $user = User::findOrFail(auth()->user()->id);
        $this->userId = $user->id;
                
        $absence = Attendance::query()
            ->where('user_id', $user->id)
            ->whereDate('created_at', now()->toDateString())
            ->where('created_at', '<=', now()->endOfDay())
            ->first();
            
        $permit = Permission::query()
            ->where('user_id', $user->id)
            ->whereDate('created_at', now()->toDateString())
            ->where('created_at', '<=', now()->endOfDay())
            ->first();

        if($absence || $permit){
            $this->checkAbsence = false; 
        }

        $isCheckOut = Institution::query()
            ->where('time_check_out', '<=', now()->format('H:i:s'))
            ->first();
        
        if ($isCheckOut) {
            if($absence->check_out){
                $this->isCheckOut = false;
            }else{
                $this->isCheckOut = true;
            }
        }

        if(isset($institution) && $institution){
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
