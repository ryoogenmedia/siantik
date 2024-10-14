<?php

namespace App\Livewire\Personnel;

use App\Models\Personnel;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
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

    public $userId;
    public $personnelId;

    public $avatarUrl;

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
                'unique:users,email,' . $this->userId,
            ],

            'kataSandi' => ['nullable', 'min:6', 'same:konfirmasiKataSandi'],
            'avatar' => ['nullable', 'file', 'image', 'max:1024'],
            'roles' => ['required','string','min:2','max:255', Rule::in(config('const.roles'))],
        ];
    }

    public function save(){
        $this->validate();

        $user = User::findOrFail($this->userId);
        $personnel = Personnel::findOrFail($this->personnelId);

        try{
            DB::beginTransaction();

            $user->update([
                'username' => $this->namaLengkap,
                'email' => $this->surel,
                'name' => $this->namaLengkap,
                'roles' => $this->roles,
            ]);

            if($this->kataSandi){
                $user->update([
                    'password' => bcrypt($this->kataSandi),
                ]);
            }

            if($this->avatar){
                if($user->avatar){
                    File::delete(public_path('storage/' . $user->avatar));
                }

                $user->update([
                    'avatar' => $this->avatar->store('avatar', 'public'),
                ]);
            }

            $personnel->update([
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

    public function mount($id){
        $personnel = Personnel::findOrFail($id);

        $this->personnelId = $personnel->id;
        $this->userId = $personnel->akun->id;

        $this->namaLengkap = $personnel->name;
        $this->nip = $personnel->nip;
        $this->nrp = $personnel->nrp;
        $this->jenisKelamin = $personnel->sex;
        $this->jabatan = $personnel->position;
        $this->surel = $personnel->akun->email;

        $this->avatarUrl = $personnel->akun->avatarUrl();
    }

    public function render()
    {
        return view('livewire.personnel.edit');
    }
}
