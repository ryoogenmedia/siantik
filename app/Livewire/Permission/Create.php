<?php

namespace App\Livewire\Permission;

use App\Models\Attendance;
use App\Models\Permission;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
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

    public $tanggalAwal;
    public $tanggalAkhir;

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

    public function save(){
        $this->validate();

        try{
            DB::beginTransaction();

            $pengguna = User::findOrFail($this->pengguna);

            $today = Carbon::today();

            $check = Permission::where('user_id', $pengguna->id)
                ->whereDate('updated_at', $today)
                ->first();

            if($check){
                session()->flash('alert', [
                    'type' => 'warning',
                    'message' => 'Bahaya',
                    'detail' => 'Perizinan hanya bisa ditambah sekali dalam sehari, izin sudah di berikan sebelumnya.',
                ]);

                return redirect()->back();
            }

            $permission = Permission::create([
                'user_id' => $pengguna->id,
                'status_permission' => $this->statusIzin,
                'information' => $this->keterangan,
                'date_start' => $this->tanggalAwal,
                'date_end' => $this->tanggalAkhir,
            ]);

            if($this->fileIzin){
                $permission->update([
                    'file' => $this->fileIzin->store('permission','public'),
                ]);
            }

            DB::commit();
        }catch(Exception $e){
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal!',
                'detail' => 'Perizinan gagal ditambahkan.',
            ]);

            return redirect()->back();
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil!',
            'detail' => 'Perizinan berhasil ditambahkan.',
        ]);

        return redirect()->route('permission.index');
    }

    public function render()
    {
        return view('livewire.permission.create');
    }
}
