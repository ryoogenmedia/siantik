<?php

namespace App\Livewire\User;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $namaLengkap;
    public $username;
    public $surel;
    public $kataSandi;
    public $konfirmasiKataSandi;
    public $avatar;

    public $roles;

    public function rules(){
        return [
            'username' => [
                'required',
                'unique:users,username',
                'min:3',
                'max:12',
                'regex:/\w*$/',
            ],
            'surel' => [
                'required',
                'email',
                'unique:users,email',
            ],
            'kataSandi' => ['required', 'min:6', 'same:konfirmasiKataSandi'],
            'avatar' => ['required', 'file', 'image', 'max:1024'],
        ];
    }

    public function save(){
        $this->validate();

        try {
            DB::beginTransaction();

            User::create([
                'username' => $this->username,
                'email' => $this->surel,
                'avatar' => $this->avatar->store('avatar', 'public'),
                'password' => bcrypt($this->kataSandi),
                'name' => $this->namaLengkap,
                'roles' => $this->roles,
            ]);

            DB::commit();
        } catch (Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal!',
                'detail' => 'Pengguna gagal disunting.',
            ]);

            return redirect()->back();
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil!',
            'detail' => 'Pengguna berhasil disunting.',
        ]);

        return redirect()->route('user.index');
    }

    public function render()
    {
        return view('livewire.user.create');
    }
}
