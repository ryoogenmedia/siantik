<?php

namespace App\Livewire\Institution;

use App\Models\Institution;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    // Properti untuk data institusi
    public $namaInstitusi;
    public $longitude;
    public $latitude;
    public $radiusLingkaran = 0;
    public $alamat;
    public $absensiPagi;
    public $absensiSiang;
    public $logo;
    public $showLogo;
    public $checkLocation = false;

    /**
     * Aturan validasi input
     */
    public function rules()
    {
        return [
            'namaInstitusi'   => ['required', 'string', 'min:2', 'max:255'],
            'radiusLingkaran' => ['required'],
            'longitude'       => ['required', 'min:2', 'max:255'],
            'latitude'        => ['required', 'min:2', 'max:255'],
            'alamat'          => ['required', 'string', 'min:2'],
            'absensiPagi'     => ['required'],
            'absensiSiang'    => ['required'],
            'logo'            => ['nullable', 'image'],
        ];
    }

    /**
     * Reset lokasi institusi ke null
     */
    public function resetLocation()
    {
        $institution = Institution::first();

        if ($institution) {
            $institution->update([
                'latitude' => null,
                'longitude' => null,
            ]);

            session()->flash('alert', [
                'type'    => 'success',
                'message' => 'Berhasil.',
                'detail'  => 'Data lokasi berhasil direset.',
            ]);
        }

        return redirect()->back();
    }

    /**
     * Menangkap event lokasi dari frontend
     */
    #[On('location')]
    public function dataLocation($latitude, $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * Menyimpan atau memperbarui data institusi
     */
    public function save()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $institution = Institution::first();

            $data = [
                'name'           => $this->namaInstitusi,
                'longitude'      => $this->longitude,
                'latitude'       => $this->latitude,
                'radius'         => $this->radiusLingkaran,
                'address'        => $this->alamat,
                'time_check_in'  => $this->absensiPagi,
                'time_check_out' => $this->absensiSiang,
            ];

            if ($institution) {
                $institution->update($data);

                if ($this->logo) {
                    // Hapus logo lama jika ada
                    if ($institution->logo) {
                        File::delete(public_path('storage/' . $institution->logo));
                    }
                    // Simpan logo baru
                    $institution->update(['logo' => $this->logo->store('logo', 'public')]);
                }
            } else {
                // Buat data baru
                $institution = Institution::create($data);

                if ($this->logo) {
                    $institution->update(['logo' => $this->logo->store('logo', 'public')]);
                }
            }

            DB::commit();

            session()->flash('alert', [
                'type'    => 'success',
                'message' => 'Berhasil.',
                'detail'  => 'Data institusi berhasil diperbarui.',
            ]);

            return redirect()->route('institution.index');
        } catch (Exception $e) {
            DB::rollBack();

            session()->flash('alert', [
                'type'    => 'danger',
                'message' => 'Gagal.',
                'detail'  => 'Data institusi gagal diperbarui.',
            ]);

            return redirect()->back();
        }
    }

    /**
     * Inisialisasi data saat komponen dimuat
     */
    public function mount()
    {
        $institution = Institution::first();

        if ($institution) {
            $this->checkLocation  = !empty($institution->longitude) && !empty($institution->latitude);
            $this->namaInstitusi  = $institution->name;
            $this->radiusLingkaran = $institution->radius;
            $this->longitude      = $institution->longitude;
            $this->latitude       = $institution->latitude;
            $this->alamat         = $institution->address;
            $this->absensiPagi    = $institution->time_check_in;
            $this->absensiSiang   = $institution->time_check_out;
            $this->showLogo       = $institution->logo ? Storage::url($institution->logo) : null;
        }
    }

    /**
     * Render tampilan Livewire
     */
    public function render()
    {
        return view('livewire.institution.index');
    }
}
