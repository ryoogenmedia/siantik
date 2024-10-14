<?php

namespace App\Livewire\Report;

use App\Models\Attendance;
use App\Models\Permission;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Admin extends Component
{
    public $bulan = '';
    public $tanggalMulai = '';
    public $tanggalSelesai = '';
    public $kategori = '';

    public $rows;

    public function filterActive(){
        $this->getDataRows();
    }

    public function resetFilter(){
        $this->reset(['bulan','tanggalMulai','tanggalSelesai','kategori']);
    }

    public function getDataRows(){
        $rows = [];

        if($this->kategori == 'izin'){
            $rows = Permission::query()
                ->when($this->tanggalMulai, function($query, $tanggalMulai){
                    $query->where('created_at', '>=', Carbon::parse($tanggalMulai));
                })
                ->when($this->tanggalSelesai, function($query, $tanggalSelesai){
                    $date_end = \Carbon\Carbon::parse($tanggalSelesai)->endOfDay();
                    $query->where('created_at', '<=', $date_end);
                })
                ->when($this->bulan, function($query, $bulan){
                    $query->whereMonth('created_at', $bulan)
                        ->whereYear('created_at', now()->year);
                })->get();
        }

        if($this->kategori == 'kehadiran'){
            $rows = Attendance::query()
            ->when($this->tanggalMulai, function($query, $tanggalMulai){
                $query->where('created_at', '>=', Carbon::parse($tanggalMulai));
            })
            ->when($this->tanggalSelesai, function($query, $tanggalSelesai){
                $date_end = \Carbon\Carbon::parse($tanggalSelesai)->endOfDay();
                $query->where('created_at', '<=', $date_end);
            })
            ->when($this->bulan, function($query, $bulan){
                $query->whereMonth('created_at', $bulan)
                    ->whereYear('created_at', now()->year);
            })->get();
        }

        $this->rows = $rows;
    }

    public function updatedKategori(){
        $this->getDataRows();
    }

    public function mount(){
        $this->rows = Attendance::all();
    }

    public function render()
    {
        return view('livewire.report.admin');
    }
}
