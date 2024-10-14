<?php

namespace App\Livewire\Institution;

use App\Models\Institution;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $namaInstitusi;
    public $longitude;
    public $latitude;
    public $radiusLingkaran = 0;

    public function rules(){
        return [
            'namaInstitusi' => ['required','string','min:2','max:255'],
            'radiusLingkaran' => ['required'],
            'longitude' => ['required','min:2','max:255'],
            'latitude' => ['required','min:2','max:255'],
        ];
    }

    #[On('location')]
    public function dataLocation($latitude, $longitude){
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function save(){
        $this->validate();

        $institution = Institution::first();

        try{
            DB::beginTransaction();

            if($institution){
                $institution->update([
                    'name' => $this->namaInstitusi,
                    'longitude' => $this->longitude,
                    'latitude' => $this->latitude,
                    'radius' => $this->radiusLingkaran,
                ]);
            }else{
                $institution = Institution::create([
                    'name' => $this->namaInstitusi,
                    'longitude' => $this->longitude,
                    'latitude' => $this->latitude,
                    'radius' => $this->radiusLingkaran,
                ]);
            }

            DB::commit();
        }catch(Exception $e){
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal.',
                'detail' => "data intitusi gagal disunting.",
            ]);

            return redirect()->route('institution.index');
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => "data institusi berhasil disunting.",
        ]);

        return redirect()->route('institution.index');
    }

    public function mount(){
        $institution = Institution::first();

        if(isset($institution) && $institution){
            $this->namaInstitusi = $institution->name;
            $this->radiusLingkaran = $institution->radius;
            $this->longitude = $institution->longitude;
            $this->latitude = $institution->latitude;
        }
    }

    public function render()
    {
        return view('livewire.institution.index');
    }
}
