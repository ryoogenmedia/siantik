<?php

namespace App\Livewire\Personnel;

use App\Models\Personnel;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    #[Computed()]
    public function rows()
    {
        return Personnel::all();
    }

    public function delete($id)
    {
        $personnel = Personnel::findOrFail($id);

        if (isset($personnel->akun)) {
            $personnel->akun->delete();
        }

        $personnel->delete();

        session()->flash('alert', [
            'type'    => 'success',
            'message' => 'Berhasil!',
            'detail'  => 'Personil berhasil dihapus.',
        ]);

        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.personnel.index');
    }
}
