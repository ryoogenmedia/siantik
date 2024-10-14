<?php

namespace App\Livewire\Permission;

use App\Models\Permission;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    #[Computed()]
    public function rows(){
        return Permission::all();
    }

    public function delete($id){
        $permission = Permission::findOrFail($id);

        $permission->delete();

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil!',
            'detail' => 'Izin berhasil dihapus.',
        ]);

        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.permission.index');
    }
}
