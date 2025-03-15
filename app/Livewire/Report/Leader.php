<?php

namespace App\Livewire\Report;

use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Leader extends Component
{
    public $keterangan;
    public $search;
    public $tanggalMulai;
    public $tanggalSelesai;

    public $rows = [];

    public function updatedSearch(){
        $this->getDataRows();
    }

    public function filterActive(){
        $this->getDataRows();
    }

    public function resetFilter(){
        $this->reset(['keterangan','search','tanggalMulai','tanggalSelesai']);
    }

    public function getDataRows(){
        $rows = [];

        $rows = User::query()
            // ->whereHas('permissions', function($query){
            //     $query->when($this->keterangan, function($query, $keterangan){
            //         $query->where('status_permission', $keterangan);
            //     })
            //     ->when($this->tanggalMulai, function($query, $tanggalMulai){
            //         $query->where('created_at', '>=', Carbon::parse($tanggalMulai));
            //     })
            //     ->when($this->tanggalSelesai, function($query, $tanggalSelesai){
            //         $date_end = \Carbon\Carbon::parse($tanggalSelesai)->endOfDay();
            //         $query->where('created_at', '<=', $date_end);
            //     })
            //     ->whereDate('created_at', now()->toDateString())
            //     ->where('created_at', '<=', now()->endOfDay());
            // })
            // ->whereHas('attendances', function($query){
            //     $query->when($this->search, function($query, $search){
            //         $query->where('name', 'LIKE', "%$search%");
            //     })
            //     ->when($this->keterangan, function($query, $keterangan){
            //         $query->where('status_attendance', $keterangan);
            //     })
            //     ->when($this->tanggalMulai, function($query, $tanggalMulai){
            //         $query->where('created_at', '>=', Carbon::parse($tanggalMulai));
            //     })
            //     ->when($this->tanggalSelesai, function($query, $tanggalSelesai){
            //         $date_end = \Carbon\Carbon::parse($tanggalSelesai)->endOfDay();
            //         $query->where('created_at', '<=', $date_end);
            //     })
            //     ->whereDate('created_at', now()->toDateString())
            //     ->where('created_at', '<=', now()->endOfDay());
            // })->where('roles', 'personil')
            ->get();

        $this->rows = $rows;
    }

    public function mount(){
        $this->getDataRows();
    }


    public function render()
    {
        return view('livewire.report.leader');
    }
}
