<?php

namespace App\Livewire\Report;

use Livewire\Component;

class LeaderDetail extends Component
{
    public $imageAbsence;
    public $personnelName;
    public $date;
    public $status;
    public $radiusLingkaran;

    public $absenceLat;
    public $absenceLng;
    public $absenceImg;

    public $institutionLat;
    public $institutionLng;
    public $institutionLogo;
    public $institutionAddress;
    public $institutionName;

    public $absenceId;

    public function render()
    {
        return view('livewire.report.leader-detail');
    }
}
