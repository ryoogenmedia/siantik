<div>
    <div class="position-relative">
        <dir>
            <x-slot name="title">Laporan Harian Dan Bulanan</x-slot>
            <x-slot name="pageTitle">Laporan Harian Dan Bulanan</x-slot>
            <x-slot name="pagePretitle">Melihat laporan harian dan bulanan presensi.</x-slot>
        </dir>

        <a href="{{ route('print.admin', [
            'date_start' => $this->tanggalMulai ?? '',
            'date_end' => $this->tanggalSelesai ?? '',
            'kategori' => $this->kategori ?? '',
            'bulan' => $this->bulan ?? '',
        ]) }}"
            class="btn btn-sm tf-btn danger position-absolute" style="width: 90px;top: -90px; right: 0">Cetak</a>
    </div>

    <x-alert />

    <div class="line4-bt pb-12">
        <div class="tf-container">
            <div class="d-flex gap-12 justify-content-between align-items-center">
                <div class="search-box">
                    <x-backend.form.select wire:model.lazy='kategori' name="kategori" class-form-group>
                        <option value="">- pilih kategori -</option>
                        <option value="izin">Daftar Perizinan</option>
                        <option value="kehadiran">Daftar Kehadiran</option>
                    </x-backend.form.select>
                </div>

                <x-filter.button target="report-admin" />
            </div>
        </div>
    </div>

    <!-- filter -->
    <x-filter.card target="report-admin" title="Filter Laporan">
        <div class="row">
            <div class="col-12">
                <x-backend.form.select wire:model.live='bulan' name="bulan" label="Pilih Bulan">
                    <option value="">- pilih -</option>
                    @foreach (config('const.month') as $key => $month)
                        <option value="{{ $key }}">{{ ucwords($month) }}</option>
                    @endforeach
                </x-backend.form.select>
            </div>

            <div class="col-12">
                <x-backend.form.input wire:model.live='tanggalMulai' name="tanggalMulai" label="Tanggal Awal"
                    type="date" />
            </div>

            <div class="col-12">
                <x-backend.form.input wire:model.live='tanggalSelesai' name="tanggalSelesai" label="Tanggal Akhir"
                    type="date" />
            </div>
        </div>
    </x-filter.card>

    @unless ($this->kategori)
        <div class="my-2">
            <div class="alert alert-info light alert-dismissible fade show mb-10" role="alert">
                <x-icon.alert.info />
                <span>Pilih kategori terlebih dahulu untuk melihat daftar laporan</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <i class="icon-close"></i>
                </button>
            </div>
        </div>
    @endunless

    @forelse ($this->rows as $row)
        <div class="order-item mb-2 mt-3">
            @if ($this->kategori == 'izin')
                <div class="img">
                    <img src="{{ $row->akun->avatarUrl() }}" alt="img">
                </div>
                <div class="content">
                    <div class="left">
                        <h6 style="font-size: 12px">{{ $row->akun->name }}</h6>
                        <p class="text-black" style="font-size: .8rem"><b>tanggal :</b>
                            {{ \Carbon\Carbon::parse($row->craeted_at)->format('d/m/Y') }}</p>
                        <p class="text-black" style="font-size: .8rem"><b>jam :</b>
                            {{ \Carbon\Carbon::parse($row->craeted_at)->format('H:i:s') }}</p>
                        <p><span class="bg-{{ $row->akun->roles == 'leader' ? 'success' : 'primary' }} text-white rounded-2 px-2"
                                style="font-size: 12px">{{ $row->akun->roles == 'leader' ? 'pimpinan' : 'personil' }}</span>
                        </p>
                    </div>
                </div>
            @else
                <div class="img">
                    <img src="{{ asset($row->image) }}" alt="img">
                </div>
                <div class="content">
                    <div class="left">
                        <h6 style="font-size: 12px">{{ $row->akun->name }}</h6>
                        <p class="text-black" style="font-size: .8rem"><b>presensi pagi :</b>
                            {{ $row->check_in }}</p>
                        <p class="text-black" style="font-size: .8rem"><b>presensi siang :</b>
                            {{ $row->check_out ?? 'belum dilakukan.' }}</p>
                        <p><span class="bg-{{ $row->akun->roles == 'leader' ? 'success' : 'primary' }} text-white rounded-2 px-2"
                                style="font-size: 12px">{{ $row->akun->roles == 'leader' ? 'pimpinan' : 'personil' }}</span>
                        </p>
                    </div>
                    <span class="price">
                        <div class="d-flex flex-wrap">
                            <a href="{{ route('report.admin-detail', ['id' => $row->id]) }}"
                                class="btn btn-sm btn-dark" style="font-size: 12px">Detail</a>
                        </div>
                    </span>
                </div>
            @endif

        </div>
    @empty
        <x-datatable.empty />
    @endforelse
</div>
