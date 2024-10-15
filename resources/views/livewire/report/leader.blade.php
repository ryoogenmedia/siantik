<div>
    <div class="position-relative">
        <dir>
            <x-slot name="title">Lapora Harian</x-slot>
            <x-slot name="pageTitle">Lapora Harian</x-slot>
            <x-slot name="pagePretitle">Melihat laporan harian.</x-slot>
        </dir>
    </div>

    <x-alert />

    <div class="line4-bt pb-12">
        <div class="tf-container">
            <div class="d-flex gap-12 justify-content-between align-items-center">
                <div class="search-box">
                    <x-backend.form.input wire:model.live='search' name="search" type="text" class-form-group
                        placeholder="Cari nama personnel..." />
                </div>

                <x-filter.button target="report-admin" />
            </div>
        </div>
    </div>

    <!-- filter -->
    <x-filter.card target="report-admin" title="Filter Laporan">
        <div class="row">
            <div class="col-12">
                <x-backend.form.select wire:model.live='keterangan' name="keterangan" label="Keterangan Absen">
                    <option value="">- pilih -</option>
                    @foreach (config('const.category_attendance') as $category)
                        <option value="{{ $category }}">{{ ucwords($category) }}</option>
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

    @forelse ($this->rows as $row)
        <div class="order-item mb-2 mt-3">
            <div class="img">
                <img src="{{ asset($row->image) }}" alt="img">
            </div>
            <div class="content">
                <div class="left">
                    <h6 style="font-size: 12px">{{ $row->akun->name }}</h6>
                    <p class="text-black" style="font-size: .8rem"><b>absen pagi :</b>
                        {{ $row->check_in }}</p>
                    <p class="text-black" style="font-size: .8rem"><b>absen siang :</b>
                        {{ $row->check_out ?? 'belum dilakukan.' }}</p>
                    <p class="text-black" style="font-size: .8rem"><b>keterangan :</b>
                        {{ $row->status_attendance }}</p>
                    <p><span class="bg-{{ $row->akun->roles == 'leader' ? 'success' : 'primary' }} text-white rounded-2 px-2"
                            style="font-size: 12px">{{ $row->akun->roles == 'leader' ? 'Pimpinan' : 'Personel' }}</span>
                    </p>
                </div>
            </div>
        </div>
    @empty
        <x-datatable.empty />
    @endforelse
</div>
