<?php

namespace App\Livewire\Report;

use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Leader extends Component
{
    public $search = "";
    public $keterangan = "";
    public $tanggalMulai = "";
    public $tanggalSelesai = "";
    public $rows = [];

    public function updatedSearch()
    {
        $this->getDataRows();
    }

    public function filterActive()
    {
        $this->getDataRows();
    }

    public function resetFilter()
    {
        $this->reset(['search', 'keterangan', 'tanggalMulai', 'tanggalSelesai']);
        $this->getDataRows();
    }

    public function getDataRows()
    {
        $query = User::query()
        ->where('roles', 'personil')
        ->when($this->search, function ($query, $search) {
            $query->where('name', 'LIKE', "%$search%");
        })
        ->when($this->keterangan, function ($query) {
            $query
            ->whereHas('permissions', function($q){
                $q->where('status_permission', $this->keterangan);
            })
            ->orWhereHas('attendances', function ($q) {
                $q->where('status_attendance', $this->keterangan);
            });
        })
        ->when($this->tanggalMulai, function ($query) {
            $query
            ->whereHas('permissions', function($q){
                $q->whereDate('created_at', '>=', Carbon::parse($this->tanggalMulai));
            })
            ->orWhereHas('attendances', function ($q) {
                $q->whereDate('created_at', '>=', Carbon::parse($this->tanggalMulai));
            });
        })
        ->when($this->tanggalSelesai, function ($query) {
            $query
            ->whereHas('permissions', function($q){
                $q->whereDate('created_at', '<=', Carbon::parse($this->tanggalSelesai)->endOfDay());
            })
            ->orWhereHas('attendances', function ($q) {
                $q->whereDate('created_at', '<=', Carbon::parse($this->tanggalSelesai)->endOfDay());
            });
        })
        ->get();


        $this->rows = $query;
    }

    public function mount()
    {
        $this->getDataRows();
    }

    public function render()
    {
        return view('livewire.report.leader');
    }
}
