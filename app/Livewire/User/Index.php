<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    #[Computed()]
    public function rows(){
        return User::all();
    }

    public function delete($id){
        $user = User::findOrFail($id);

        if($user->avatar){
            File::delete(public_path('storage/' . $user->avatar));
        }

        if(isset($user->personnel)){
            $user->personnel->delete();
        }

        if(isset($user->leader)){
            $user->leader->delete();
        }

        $user->delete();

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil!',
            'detail' => 'Pengguna berhasil dihapus.',
        ]);

        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.user.index');
    }
}
