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
            ->where('roles', 'personil') // Hanya user dengan peran "personil"
            ->when($this->search, function ($query, $search) {
                $query->whereHas('attendances', fn($q) => $q->where('name', 'LIKE', "%{$search}%"));
            })
            ->when($this->keterangan, function ($query, $keterangan) {
                $query->whereHas('attendances', fn($q) => $q->where('status_attendance', $keterangan));
            })
            ->when($this->tanggalMulai, function ($query, $tanggalMulai) {
                $query->whereHas('attendances', fn($q) =>
                    $q->whereDate('created_at', '>=', Carbon::parse($tanggalMulai))
                );
            })
            ->when($this->tanggalSelesai, function ($query, $tanggalSelesai) {
                $query->whereHas('attendances', fn($q) =>
                    $q->whereDate('created_at', '<=', Carbon::parse($tanggalSelesai)->endOfDay())
                );
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
