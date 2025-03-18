<?php

namespace App\Livewire\Report;

use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Leader extends Component
{
    public $keterangan = "";
    public $search = "";
    public $tanggalMulai = "";
    public $tanggalSelesai = "";
    public $rows = [];

    public function updatedSearch(){
        $this->getDataRows();
    }

    public function filterActive(){
        $this->getDataRows();
    }

    public function resetFilter(){
        $this->reset(['keterangan','search','tanggalMulai','tanggalSelesai']);
        $this->getDataRows();
    }

    public function getDataRows(){
        $query = User::query()
            ->whereHas('attendances', function($query) {
                $query->when($this->search, function($query) {
                    $query->where('name', 'LIKE', "%{$this->search}%");
                })
                ->when($this->keterangan, function($query) {
                    $query->where('status_attendance', $this->keterangan);
                })
                ->when($this->tanggalMulai, function($query) {
                    $query->whereDate('created_at', '>=', Carbon::parse($this->tanggalMulai));
                })
                ->when($this->tanggalSelesai, function($query) {
                    $query->whereDate('created_at', '<=', Carbon::parse($this->tanggalSelesai)->endOfDay());
                });
            })
            ->where('roles', 'personil') // Menyaring user dengan peran "personil"
            ->get();

        $this->rows = $query;
    }

    public function mount(){
        $this->getDataRows();
    }

    public function render()
    {
        return view('livewire.report.leader');
    }
}
