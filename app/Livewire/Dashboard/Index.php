<?php

namespace App\Livewire\Dashboard;

use App\Helpers\Maps;
use App\Models\Attendance;
use App\Models\Institution;
use App\Models\Permission;
use App\Models\Personnel;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Index extends Component
{
    public $jmlPersonnel;
    public $jmlPengguna;
    public $radiusLingkaran;
    public $attendance;
    public $markerIcon;

    public $institutionLat;
    public $institutionLng;
    public $institutionName;
    public $institutionLogo;
    public $institutionAddress;


    public $jmlHadir;
    public $jmlSakit;
    public $jmlCuti;
    public $jmlIzin;
    public $jmlTugas;
    public $jmlPendidikan;
    public $jmlTerlambat;

    public $bulan;

    public $jmlKehadiran;
    public $jmlPerizinan;
    public $checkLocation = false;
    public $isAbsence = true;

    public function getCounterData()
    {
        if (auth()->user()->roles == 'admin') {
            $this->attendance = Maps::ATTENDANCE(now());
            $institution = Institution::first();

            if (isset($institution) && $institution) {
                if ($institution->longitude && $institution->latitude) {
                    $this->checkLocation = true;
                }

                $this->institutionName = $institution->name;
                $this->radiusLingkaran = $institution->radius;
                $this->institutionLat = $institution->latitude;
                $this->institutionLng = $institution->longitude;

                $this->institutionAddress = $institution->address;
                $this->institutionLogo = $institution->logo ? Storage::url($institution->logo) : null;
                $this->markerIcon = asset('assets/images/marker-maps.webp');
            }

            $this->jmlHadir = Attendance::query()
                ->when($this->bulan, function ($query, $bulan) {
                    $query->whereMonth('created_at', $bulan)
                        ->whereYear('created_at', now()->year);
                })
                ->count();

            $this->jmlSakit = Permission::query()
                ->when($this->bulan, function ($query, $bulan) {
                    $query->whereMonth('created_at', $bulan)
                        ->whereYear('created_at', now()->year);
                })
                ->where('status_permission', 'sakit')
                ->count();

            $this->jmlCuti = Permission::query()
                ->when($this->bulan, function ($query, $bulan) {
                    $query->whereMonth('created_at', $bulan)
                        ->whereYear('created_at', now()->year);
                })
                ->where('status_permission', 'cuti')
                ->count();

            $this->jmlIzin = Permission::query()
                ->when($this->bulan, function ($query, $bulan) {
                    $query->whereMonth('created_at', $bulan)
                        ->whereYear('created_at', now()->year);
                })
                ->where('status_permission', 'izin')
                ->count();

            $this->jmlTugas = Permission::query()
                ->when($this->bulan, function ($query, $bulan) {
                    $query->whereMonth('created_at', $bulan)
                        ->whereYear('created_at', now()->year);
                })
                ->where('status_permission', 'tugas')
                ->count();

            $this->jmlPendidikan = Permission::query()
                ->when($this->bulan, function ($query, $bulan) {
                    $query->whereMonth('created_at', $bulan)
                        ->whereYear('created_at', now()->year);
                })
                ->where('status_permission', 'pendidikan')
                ->count();

            $this->jmlTerlambat = Attendance::query()
                ->when($this->bulan, function ($query, $bulan) {
                    $query->whereMonth('created_at', $bulan)
                        ->whereYear('created_at', now()->year);
                })
                ->where('status_attendance', 'terlambat')
                ->count();
        }
    }

    public function updatedBulan()
    {
        if (auth()->user()->roles == 'admin') {
            $this->jmlHadir = Attendance::query()
                ->when($this->bulan, function ($query, $bulan) {
                    $query->whereMonth('created_at', $bulan)
                        ->whereYear('created_at', now()->year);
                })
                ->count();

            $this->jmlSakit = Permission::query()
                ->when($this->bulan, function ($query, $bulan) {
                    $query->whereMonth('created_at', $bulan)
                        ->whereYear('created_at', now()->year);
                })
                ->where('status_permission', 'sakit')
                ->count();

            $this->jmlCuti = Permission::query()
                ->when($this->bulan, function ($query, $bulan) {
                    $query->whereMonth('created_at', $bulan)
                        ->whereYear('created_at', now()->year);
                })
                ->where('status_permission', 'cuti')
                ->count();

            $this->jmlIzin = Permission::query()
                ->when($this->bulan, function ($query, $bulan) {
                    $query->whereMonth('created_at', $bulan)
                        ->whereYear('created_at', now()->year);
                })
                ->where('status_permission', 'izin')
                ->count();

            $this->jmlTugas = Permission::query()
                ->when($this->bulan, function ($query, $bulan) {
                    $query->whereMonth('created_at', $bulan)
                        ->whereYear('created_at', now()->year);
                })
                ->where('status_permission', 'tugas')
                ->count();

            $this->jmlPendidikan = Permission::query()
                ->when($this->bulan, function ($query, $bulan) {
                    $query->whereMonth('created_at', $bulan)
                        ->whereYear('created_at', now()->year);
                })
                ->where('status_permission', 'pendidikan')
                ->count();

            $this->jmlTerlambat = Attendance::query()
                ->when($this->bulan, function ($query, $bulan) {
                    $query->whereMonth('created_at', $bulan)
                        ->whereYear('created_at', now()->year);
                })
                ->where('status_attendance', 'terlambat')
                ->count();
        }
    }

    public function mount()
    {

        if (auth()->user()->roles == 'superadmin') {
            $this->jmlPengguna = User::count();
            $this->jmlPersonnel = Personnel::count();
            $this->radiusLingkaran = Institution::first()->radius ?? null;
        }

        if (auth()->user()->roles == 'personil') {
            $user = auth()->user();
            $status = null;

            $this->attendance = Maps::ATTENDANCE(now(), $status, $user->id);
            $institution = Institution::first();

            $this->institutionName = $institution->name;
            $this->radiusLingkaran = $institution->radius;
            $this->institutionLat = $institution->latitude;
            $this->institutionLng = $institution->longitude;

            $this->institutionAddress = $institution->address;
            $this->institutionLogo = $institution->logo ? Storage::url($institution->logo) : null;
            $this->markerIcon = asset('assets/images/marker-maps.webp');

            $this->jmlKehadiran = Attendance::query()
                ->where('user_id', auth()->user()->id)
                ->count();

            $this->jmlPerizinan = Permission::query()
                ->where('user_id', auth()->user()->id)
                ->count();

            $absence = Attendance::query()
                ->where('user_id', auth()->user()->id)
                ->whereDate('created_at', now()->toDateString())
                ->where('created_at', '<=', now()->endOfDay())
                ->first();

            if (isset($absence) && $absence) {
                $this->isAbsence = false;
            }
        }

        if (auth()->user()->roles == 'leader') {
            $this->attendance = Maps::ATTENDANCE(now());
            $institution = Institution::first();

            if (isset($institution) && $institution) {
                if ($institution->longitude && $institution->latitude) {
                    $this->checkLocation = true;
                }

                $this->institutionName = $institution->name;
                $this->radiusLingkaran = $institution->radius;
                $this->institutionLat = $institution->latitude;
                $this->institutionLng = $institution->longitude;

                $this->institutionAddress = $institution->address;
                $this->institutionLogo = $institution->logo ? Storage::url($institution->logo) : null;
                $this->markerIcon = asset('assets/images/marker-maps.webp');
            }

            $this->jmlKehadiran = Attendance::query()
                ->whereDate('created_at', now()->toDateString())
                ->where('created_at', '<=', now()->endOfDay())
                ->whereNot('user_id', auth()->user()->id)
                ->count();

            $this->jmlPerizinan = Permission::query()
                ->whereDate('created_at', now()->toDateString())
                ->whereNot('user_id', auth()->user()->id)
                ->count();

            $absence = Attendance::query()
                ->where('user_id', auth()->user()->id)
                ->whereDate('created_at', now()->toDateString())
                ->first();

            if (isset($absence) && $absence) {
                $this->isAbsence = false;
            }
        }

        $this->getCounterData();
    }

    public function render()
    {
        return view('livewire.dashboard.index');
    }
}
