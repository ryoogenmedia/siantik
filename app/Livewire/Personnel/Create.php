<?php

namespace App\Livewire\Personnel;

use App\Models\Personnel;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $namaLengkap;
    public $nip;
    public $nrp;
    public $jenisKelamin;
    public $jabatan;

    public $surel;
    public $kataSandi;
    public $konfirmasiKataSandi;
    public $roles = 'personnel';
    public $avatar;

    public function rules(){
        return [
            'namaLengkap' => ['required','string','min:2','max:255'],
            'nip' => ['required','string','min:2','max:255'],
            'nrp' => ['required','string','min:2','max:255'],
            'jenisKelamin' => ['required','string','min:2','max:255',Rule::in(config('const.sex'))],
            'jabatan' => ['required','string','min:2','max:255',Rule::in(config('const.position'))],

            'surel' => [
                'required',
                'email',
                'unique:users,email',
            ],
            'kataSandi' => ['required', 'min:6', 'same:konfirmasiKataSandi'],
            'avatar' => ['required', 'file', 'image', 'max:1024'],
            'roles' => ['required','string','min:2','max:255', Rule::in(config('const.roles'))],
        ];
    }

    public function save(){
        $this->validate();

        try{
            DB::beginTransaction();

            $user = User::create([
                'username' => $this->namaLengkap,
                'email' => $this->surel,
                'password' => bcrypt($this->kataSandi),
                'name' => $this->namaLengkap,
                'roles' => $this->roles,
            ]);

            if($this->avatar){
                $user->update([
                    'avatar' => $this->avatar->store('avatar', 'public'),
                ]);
            }

            Personnel::create([
                'user_id' => $user->id,
                'name' => $this->namaLengkap,
                'nip' => $this->nip,
                'nrp' => $this->nrp,
                'position' => $this->jabatan,
                'sex' => $this->jenisKelamin,
            ]);

            DB::commit();
        }catch(Exception $e){
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal!',
                'detail' => 'Personnel gagal ditambah.',
            ]);

            return redirect()->back();
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil!',
            'detail' => 'Personnel berhasil ditambah.',
        ]);

        return redirect()->route('personnel.index');
    }

    public function render()
    {
        return view('livewire.personnel.create');
    }
}