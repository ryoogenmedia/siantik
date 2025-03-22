<?php

namespace App\Livewire\Report;

use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Leader extends Component
{
    public $search = "";
    public $keterangan = "";
    public $tanggalMulai = "";
    public $tanggalSelesai = "";
    public $rows = [];
    public $permission = false;

    public function showPermission($status)
    {
        $this->permission = $status;
        $this->getDataRows();
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['search', 'keterangan', 'tanggalMulai', 'tanggalSelesai'])) {
            $this->getDataRows();
        }
    }

    #[Computed()]
    public function personnels()
    {
        return User::where('roles', 'personil')->get();
    }

    public function resetFilter()
    {
        $this->reset(['search', 'keterangan', 'tanggalMulai', 'tanggalSelesai']);
        $this->getDataRows();
    }

    public function getDataRows()
    {
        $query = User::where('roles', 'personil')
            ->when(!empty($this->search), function ($q) {
                $q->where('name', 'LIKE', "%{$this->search}%");
            })
            ->when(!empty($this->keterangan), function ($q) {
                if ($this->permission) {
                    // Jika mode Perizinan aktif, filter berdasarkan `status_permission`
                    $q->whereHas('permissions', function ($q) {
                        $q->where('status_permission', $this->keterangan);
                    });
                } else {
                    // Jika mode Presensi aktif, filter berdasarkan `status_attendance`
                    $q->whereHas('attendances', function ($q) {
                        $q->where('status_attendance', $this->keterangan);
                    });
                }
            })
            ->when(!empty($this->tanggalMulai), function ($q) {
                $q->whereHas('attendances', function ($q) {
                    $q->whereDate('created_at', '>=', Carbon::parse($this->tanggalMulai)->startOfDay());
                });
            })
            ->when(!empty($this->tanggalSelesai), function ($q) {
                $q->whereHas('attendances', function ($q) {
                    $q->whereDate('created_at', '<=', Carbon::parse($this->tanggalSelesai)->endOfDay());
                });
            });

        $this->rows = $query->get();
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
