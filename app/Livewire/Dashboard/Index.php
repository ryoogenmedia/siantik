<?php

namespace App\Livewire\Dashboard;

use App\Models\Institution;
use App\Models\Personnel;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $jmlPersonnel;
    public $jmlPengguna;
    public $radiusLingkaran;

    public function mount(){

        if(auth()->user()->roles == 'superadmin'){
            $this->jmlPengguna = User::count();
            $this->jmlPersonnel = Personnel::count();
            $this->radiusLingkaran = Institution::first()->radius ?? null;
        }
    }

    public function render()
    {
        return view('livewire.dashboard.index');
    }
}
