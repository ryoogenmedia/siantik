<?php

namespace App\Livewire\Report;

use App\Models\Attendance;
use App\Models\Institution;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class LeaderDetail extends Component
{
    public $imageAbsence;
    public $personnelName;
    public $date;
    public $status;
    public $radiusLingkaran;
    public $numberIdentity;
    public $absenceLat;
    public $absenceLng;
    public $absenceImg;
    public $emailPersonnel;
    public $institutionLat;
    public $institutionLng;
    public $institutionLogo;
    public $institutionAddress;
    public $institutionName;
    public $markerIcon;

    public $absenceId;

    public function mount($id)
    {
        $absence = Attendance::findOrFail($id);
        $institution = Institution::first();

        $this->imageAbsence = $absence->image;
        $this->personnelName = $absence->akun->personnel->name;
        $this->date = $absence->created_at;
        $this->status = $absence->status_attendance;
        $this->numberIdentity = $absence->akun->personnel->number_identity;
        $this->emailPersonnel = $absence->akun->email;

        $this->absenceLat = $absence->latitude;
        $this->absenceLng = $absence->longitude;
        $this->absenceImg = $absence->akun->avatarUrl();
        $this->markerIcon = asset('assets/images/marker-maps.webp');

        if (isset($institution) && $institution) {
            $this->radiusLingkaran = $institution->radius;
            $this->institutionLat = $institution->latitude;
            $this->institutionLng = $institution->longitude;
            $this->institutionLogo = $institution->logo ? Storage::url($institution->logo) : null;
            $this->institutionAddress = $institution->address;
            $this->institutionName = $institution->name;
        }
    }
    public function render()
    {
        return view('livewire.report.leader-detail');
    }
}
