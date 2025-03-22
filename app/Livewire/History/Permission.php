<?php

namespace App\Livewire\History;

use App\Models\Permission as ModelsPermission;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Permission extends Component
{
    #[Computed()]
    public function permissions()
    {
        $data = [];

        $data = ModelsPermission::where('user_id', auth()->id())->latest()->get();

        return $data;
    }

    public function render()
    {
        return view('livewire.history.permission');
    }
}
