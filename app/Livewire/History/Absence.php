<?php

namespace App\Livewire\History;

use App\Models\Attendance;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Absence extends Component
{

    #[Computed()]
    public function attendances()
    {
        $data = [];

        $data = Attendance::where('user_id', auth()->id())->latest()->get();

        return $data;
    }

    public function render()
    {
        return view('livewire.history.absence');
    }
}
