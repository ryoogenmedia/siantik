<?php

namespace App\Livewire\Permission;

use App\Models\Permission;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $roles;
    public $pengguna;
    public $namaPengguna;
    public $keterangan;
    public $statusIzin;
    public $fileIzin;

    public $personnel;
    public $nip;
    public $nrp;
    public $jabatan;

    public $avatarUrl;

    public $listUser;

    public $permissionId;

    public function rules(){
        return [
            'roles' => ['required','string','min:2','max:255', Rule::in(config('const.roles'))],
            'pengguna' => ['required'],
            'namaPengguna' => ['required','string','min:2','max:255'],
            'statusIzin' => ['required','string','min:2','max:255'],
            'fileIzin' => ['nullable','file'],
            'keterangan' => ['nullable','string','min:2','max:255'],
        ];
    }

    public function updatedRoles(){
        $user = [];

        if($this->roles){
            $this->listUser = [];
            $this->reset(['pengguna', 'personnel']);

            $user = User::query()
                ->where('roles', $this->roles)
                ->get();
        }

        $this->listUser = $user;
    }

    public function updatedPengguna(){
        $nama = "";

        if($this->pengguna){
            $this->namaPengguna = "";
            $this->personnel = null;
            $user = User::findOrFail($this->pengguna);
            $this->avatarUrl = $user->avatarUrl();

            if(isset($user->personnel)){
                $this->personnel = $user->personnel ?? null;
                $this->nip = $user->personnel->nip;
                $this->nrp = $user->personnel->nrp;
                $this->jabatan = $user->personnel->position;
            }

            $nama = $user->name;
        }

        $this->namaPengguna = $nama;
    }

    public function edit(){
        $this->validate();


        try{
            DB::beginTransaction();

            $permission = Permission::findOrFail($this->permissionId);
            $pengguna = User::findOrFail($this->pengguna);

            $permission->update([
                'user_id' => $pengguna->id,
                'status_permission' => $this->statusIzin,
                'information' => $this->keterangan,
            ]);

            if($this->fileIzin){
                if($permission->file){
                    File::delete(public_path('storage/' . $permission->file));
                }

                $permission->update([
                    'file' => $this->fileIzin->store('permission','public'),
                ]);
            }

            DB::commit();
        }catch(Exception $e){
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal!',
                'detail' => 'Perizinan gagal disunting.',
            ]);

            return redirect()->back();
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil!',
            'detail' => 'Perizinan berhasil disunting.',
        ]);

        return redirect()->route('permission.index');
    }

    public function mount($id){
        $permission = Permission::findOrFail($id);

        $this->permissionId = $permission->id;
        $this->roles = $permission->akun->roles;
        $this->namaPengguna = $permission->akun->name;
        $this->pengguna = $permission->akun->id;
        $this->keterangan = $permission->information;
        $this->statusIzin = $permission->status_permission;
        $this->avatarUrl = $permission->akun->avatarUrl();

        if($this->roles){
            $this->listUser = User::where('roles', $this->roles)->get();
        }

        if($this->roles == 'personnel'){
            $this->nip = $permission->akun->personnel->nip;
            $this->nrp = $permission->akun->personnel->nrp;
            $this->jabatan = $permission->akun->personnel->position;
        }
    }

    public function render()
    {
        return view('livewire.permission.edit');
    }
}
