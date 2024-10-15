<div>
    <x-slot name="title">Beranda</x-slot>
    <x-slot name="pageTitle">Dashboard</x-slot>
    <x-slot name="pagePretitle">Ringkasan aplikasi anda berada disini.</x-slot>

    @if (auth()->user()->roles == 'personnel')

        @if (isset($this->isAbsence))
            <div class="row mb-2">
                <div class="col-12">
                    <div class="card border border-success">
                        <div class="card-header text-success">Anda Telah Melakukan Absensi Hari Ini.</div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-6">
                <div class="card mb-2">
                    <div class="card-header text-primary">Kehadiran</div>
                    <div class="card-body">
                        <h3>{{ $this->jmlKehadiran ?? 0 }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card mb-2">
                    <div class="card-header text-primary">Pengajuan Perizinan</div>
                    <div class="card-body">
                        <h3>{{ $this->jmlPerizinan ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->roles == 'superadmin')
        <div class="row">
            <div class="col-6">
                <div class="card mb-2">
                    <div class="card-header text-primary">Jumlah Pengguna</div>
                    <div class="card-body">
                        <h3>{{ $this->jmlPengguna ?? 0 }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card mb-2">
                    <div class="card-header text-primary">Jumlah Personnel</div>
                    <div class="card-body">
                        <h3>{{ $this->jmlPersonnel ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="card mb-2">
                    <div class="card-header text-primary">Radius Lingkaran Absensi</div>
                    <div class="card-body">
                        <h3>{{ $this->radiusLingkaran ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->roles == 'admin')
        <div class="line4-bt pb-12">
            <div class="tf-container">
                <div class="d-flex gap-12 justify-content-between align-items-center">
                    <div class="search-box">
                        <x-backend.form.select wire:model.lazy='bulan' name="bulan" class-form-group>
                            <option value="">- semua bulan -</option>
                            @foreach (config('const.month') as $bulan)
                                <option value="{{ $loop->iteration }}">{{ $bulan }}</option>
                            @endforeach
                        </x-backend.form.select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="card mb-2">
                    <div class="card-header text-primary">Hadir</div>
                    <div class="card-body">
                        <h3>{{ $this->jmlHadir }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card mb-2">
                    <div class="card-header text-primary">Izin</div>
                    <div class="card-body">
                        <h3>{{ $this->jmlIzin }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card mb-2">
                    <div class="card-header text-primary">Cuti</div>
                    <div class="card-body">
                        <h3>{{ $this->jmlCuti }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card mb-2">
                    <div class="card-header text-primary">Tugas</div>
                    <div class="card-body">
                        <h3>{{ $this->jmlTugas }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card mb-2">
                    <div class="card-header text-primary">Pendidikan</div>
                    <div class="card-body">
                        <h3>{{ $this->jmlPendidikan }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card mb-2">
                    <div class="card-header text-primary">Terlambat</div>
                    <div class="card-body">
                        <h3>{{ $this->jmlTerlambat }}</h3>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
