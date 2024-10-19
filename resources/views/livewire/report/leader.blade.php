<div>
    <div class="position-relative">
        <dir>
            <x-slot name="title">Laporan Harian</x-slot>
            <x-slot name="pageTitle">Laporan Harian</x-slot>
            <x-slot name="pagePretitle">Melihat laporan harian presensi personnel.</x-slot>
        </dir>

        <a target="_blank" class="btn btn-sm tf-btn danger position-absolute"
            style="width: 90px;top: -90px; right: 0">Cetak</a>
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
        <div class="order-item mb-2 mt-3">
            @foreach ($row->attendances as $attendance)
                <div class="img">
                    <img src="{{ asset($attendance->image) }}" alt="img">
                </div>

                <div class="content">
                    <div class="left">
                        <h6 class="fw-bold mb-2" style="font-size: 14px">{{ $attendance->name }}</h6>
                        <table>
                            <tr>
                                <td>
                                    <p class="text-black fw-bold" style="font-size: .8rem">absen pagi</p>
                                </td>
                                <td>
                                    <p class="text-black px-2 fw-bold" style="font-size: .8rem">:</p>
                                </td>
                                <td>
                                    <p class="text-black" style="font-size: .8rem">{{ $attendance->check_in }}</p>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="text-black fw-bold" style="font-size: .8rem">absen siang</p>
                                </td>
                                <td>
                                    <p class="text-black px-2 fw-bold" style="font-size: .8rem">:</p>
                                </td>
                                <td>
                                    <p class="text-black" style="font-size: .8rem">{{ $attendance->check_out }}</p>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="text-black fw-bold" style="font-size: .8rem">keterangan</p>
                                </td>
                                <td>
                                    <p class="text-black px-2 fw-bold" style="font-size: .8rem">:</p>
                                </td>
                                <td>
                                    <p class="text-black" style="font-size: .8rem">{{ $attendance->status_attendance }}
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <span class="price">
                        <div class="d-flex flex-wrap">
                            <a class="btn btn-sm btn-dark" style="font-size: 12px">Detail</a>
                        </div>
                    </span>
                </div>
            @endforeach

            @foreach ($row->permissions as $permission)
                <div class="img">
                    <img src="{{ asset($permission->akun->avatarUrl()) }}" alt="img">
                </div>

                <div class="content">
                    <div class="left">
                        <h6 class="fw-bold mb-2" style="font-size: 14px">{{ $permission->akun->name }}</h6>
                        <table>
                            <tr>
                                <td>
                                    <p class="text-black fw-bold" style="font-size: .8rem">tanggal</p>
                                </td>
                                <td>
                                    <p class="text-black px-2 fw-bold" style="font-size: .8rem">:</p>
                                </td>
                                <td>
                                    <p class="text-black" style="font-size: .8rem">
                                        {{ $permission->created_at->format('d-m-Y') }}</p>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="text-black fw-bold" style="font-size: .8rem">waktu</p>
                                </td>
                                <td>
                                    <p class="text-black px-2 fw-bold" style="font-size: .8rem">:</p>
                                </td>
                                <td>
                                    <p class="text-black" style="font-size: .8rem">
                                        {{ $permission->created_at->format('H:i:s') }}</p>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="text-black fw-bold" style="font-size: .8rem">keterangan</p>
                                </td>
                                <td>
                                    <p class="text-black px-2 fw-bold" style="font-size: .8rem">:</p>
                                </td>
                                <td>
                                    <p class="text-black" style="font-size: .8rem">{{ $permission->status_permission }}
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            @endforeach
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
