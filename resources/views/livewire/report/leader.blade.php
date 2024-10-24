<div>
    <div class="position-relative">
        <dir>
            <x-slot name="title">Laporan Harian</x-slot>
            <x-slot name="pageTitle">Laporan Harian</x-slot>
            <x-slot name="pagePretitle">Melihat laporan harian presensi personnel.</x-slot>
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

    <x-filter.card target="report-admin" title="Filter Laporan">
        <div class="row">
            <div class="col-12">
                <x-backend.form.select wire:model.live='keterangan' name="keterangan" label="Keterangan">
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
        <div class="order-item d-flex">
            <div class="row">
                <div class="col-12">
                    @foreach ($row->attendances as $attendance)
                        <div class="d-flex mt-5 justify-content-between">
                            <div class="img">
                                <img src="{{ asset($attendance->image) }}" alt="img">
                            </div>

                            <div class="content ms-1">
                                <div class="left">
                                    <h6 style="font-size: 14px" class="fw-bold mb-2">{{ $attendance->name }}</h6>
                                    <p class="text-black" style="font-size: .8rem"><b>absen pagi :</b>
                                        {{ $attendance->check_in }}
                                    </p>
                                    <p class="text-black" style="font-size: .8rem"><b>absen siang :</b>
                                        {{ $attendance->check_out ?? 'belum dilakukan.' }}
                                    </p>
                                    <p class="text-black" style="font-size: .8rem"><b>Keterangan :</b>
                                        {{ $attendance->status_attendance }}
                                    </p>
                                    <p><span class="bg-{{ $attendance->akun->roles == 'leader' ? 'success' : 'primary' }} text-white rounded-2 px-2"
                                            style="font-size: 12px">{{ $attendance->akun->roles == 'leader' ? 'Pimpinan' : 'Personel' }}</span>
                                    </p>
                                </div>

                                <span class="price ms-5">
                                    <div class="d-flex flex-wrap">
                                        <a href="{{ route('daily-report.leader-detail', ['id' => $attendance->id]) }}"
                                            class="btn btn-sm btn-dark" style="font-size: 12px">Detail</a>
                                    </div>
                                </span>
                            </div>
                        </div>
                    @endforeach

                    @foreach ($row->permissions as $permission)
                        <div class="d-flex mt-5 justify-between">
                            <div class="img">
                                <img src="{{ asset($permission->akun->avatarUrl()) }}" alt="img">
                            </div>

                            <div class="content ms-1">
                                <div class="left">
                                    <h6 class="fw-bold mb-2" style="font-size: 14px">{{ $permission->akun->name }}</h6>
                                    <p class="text-black fw-bold" style="font-size: .8rem"><b>tanggal :</b>
                                        {{ $permission->created_at->format('d-m-Y') }}
                                    </p>
                                    <p class="text-black fw-bold" style="font-size: .8rem"><b>tanggal :</b>
                                        {{ $permission->created_at->format('d-m-Y') }}
                                    </p>
                                    <p class="text-black fw-bold" style="font-size: .8rem"><b>waktu :</b>
                                        {{ $permission->created_at->format('H:i:s') }}
                                    </p>
                                    <p class="text-black fw-bold" style="font-size: .8rem"><b>keterangan :</b>
                                        {{ $permission->status_permission }}
                                    </p>
                                    <p><span class="bg-{{ $attendance->akun->roles == 'leader' ? 'success' : 'primary' }} text-white rounded-2 px-2"
                                            style="font-size: 12px">{{ $attendance->akun->roles == 'leader' ? 'Pimpinan' : 'Personel' }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

        @if (
            !isset($row->attendances) &&
                count($row->attendances) <= 0 &&
                !isset($row->permissions) &&
                count($row->permissions) <= 0)
            <x-datatable.empty />
        @endif
    @empty
        <x-datatable.empty />
    @endforelse

</div>
