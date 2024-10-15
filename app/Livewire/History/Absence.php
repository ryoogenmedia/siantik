<?php

namespace App\Livewire\History;

use App\Models\Attendance;
use App\Models\User;
use Livewire\Component;

class Absence extends Component
{
    public $rows;

    public function mount(){
        $user = User::findOrFail(auth()->user()->id);

        $rows = [];

        $rows = Attendance::query()
            ->where('user_id', $user->id)
            ->get();

        $this->rows = $rows;
    }

    public function render()
    {
        return view('livewire.history.absence');
    }
}
