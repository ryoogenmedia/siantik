<div>
    <x-slot name="title">Laporan Harian</x-slot>
    <x-slot name="pageTitle">Laporan Harian</x-slot>
    <x-slot name="pagePretitle">Melihat laporan harian presensi personil.</x-slot>

    <x-alert />

    <div class="line4-bt pb-12">
        <div class="tf-container">
            <div class="d-flex gap-12 justify-content-between align-items-center">
                <div class="search-box">
                    <x-backend.form.input wire:model.live='search' name="search" type="text" class-form-group
                        placeholder="Cari nama personil..." />
                </div>
                <x-filter.button target="report-leader" />
            </div>
            <div class="d-flex gap-12 justify-content-between align-items-center mt-2">
                <div class="search-box">
                    <x-backend.form.select wire:model.lazy="keterangan" name="keterangan">
                        <option value="">- semua -</option>
                        @if ($this->permission)
                            @foreach (config('const.permission_status') as $status)
                                <option value="{{ $status }}">{{ $status }}</option>
                            @endforeach
                        @else
                            @foreach (config('const.presensi_status') as $status)
                                <option value="{{ $status }}">{{ $status }}</option>
                            @endforeach
                        @endif
                    </x-backend.form.select>
                </div>
            </div>
        </div>
    </div>

    <x-filter.card target="report-leader" title="Filter Laporan">
        <div class="row">
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

    <div class="d-flex gap-3">
        <button wire:click="showPermission(false)"
            class="btn {{ !$this->permission ? 'btn-primary' : 'btn-outline-primary' }}">
            Presensi
        </button>

        <button wire:click="showPermission(true)"
            class="btn {{ $this->permission ? 'btn-primary' : 'btn-outline-primary' }}">
            Perizinan
        </button>
    </div>

    @unless ($this->permission)
        <div class="d-flex flex-wrap flex-column">
            @foreach ($this->rows as $row)
                @foreach ($row->attendances as $attendance)
                    @if (isset($attendance->status_attendance) && in_array($attendance->status_attendance, config('const.presensi_status')))
                        <div class="d-flex mb-1 mt-3 pb-5 pt-3 flex-wrap border-bottom">
                            @if ($attendance->check_in_id && isset($attendance->check_in))
                                <div class="order-item pe-2">
                                    <div class="d-flex pe-3">
                                        <img class="m-auto"
                                            style="width: 50px; height: 50px; object-fit: cover; border-radius: 100%"
                                            src="{{ $attendance->check_in->imageUrl() }}"
                                            alt="Check-in {{ $attendance->akun->name }}">
                                    </div>
                                    <table style="font-size: 13px; color: #000">
                                        <tr>
                                            <td colspan="2">
                                                <p class="py-1 px-2 d-inline rounded-2 mb-3"
                                                    style="background-color: #bfffb9; color: #41a722">
                                                    Presensi Masuk</p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><b>Nama Personil</b></td>
                                            <td style="padding: 0 5px">:</td>
                                            <td>{{ $attendance->akun->name }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Jenis Kelamin</b></td>
                                            <td style="padding: 0 5px">:</td>
                                            <td>{{ $attendance->akun->personnel->sex }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>NRP / NIP</b></td>
                                            <td style="padding: 0 5px">:</td>
                                            <td>{{ $attendance->akun->personnel->number_identity }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Posisi</b></td>
                                            <td style="padding: 0 5px">:</td>
                                            <td>{{ $attendance->akun->personnel->position }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Waktu Masuk</b></td>
                                            <td style="padding: 0 5px">:</td>
                                            <td>{{ Carbon\Carbon::parse($attendance->created_at)->format('d/m/y - H:i:s') }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><b>Status</b></td>
                                            <td style="padding: 0 5px">:</td>
                                            <td>{{ strtoupper($attendance->status_attendance) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            @endif

                            @if ($attendance->check_out_id && isset($attendance->check_out))
                                <div class="order-item mt-5">
                                    <div class="d-flex pe-3">
                                        <img class="m-auto"
                                            style="width: 50px; height: 50px; object-fit: cover; border-radius: 100%"
                                            src="{{ $attendance->check_out->imageUrl() }}"
                                            alt="Check-in {{ $attendance->akun->name }}">
                                    </div>
                                    <table style="font-size: 13px; color: #000">
                                        <tr>
                                            <td colspan="2">
                                                <p class="py-1 px-2 d-inline rounded-2 mb-3"
                                                    style="background-color: #ffb9b9; color: #a72222">
                                                    Presensi Keluar</p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><b>Nama Personil</b></td>
                                            <td style="padding: 0 5px">:</td>
                                            <td>{{ $attendance->akun->name }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Jenis Kelamin</b></td>
                                            <td style="padding: 0 5px">:</td>
                                            <td>{{ $attendance->akun->personnel->sex }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>NRP / NIP</b></td>
                                            <td style="padding: 0 5px">:</td>
                                            <td>{{ $attendance->akun->personnel->number_identity }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Posisi</b></td>
                                            <td style="padding: 0 5px">:</td>
                                            <td>{{ $attendance->akun->personnel->position }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Waktu Keluar</b></td>
                                            <td style="padding: 0 5px">:</td>
                                            <td>{{ Carbon\Carbon::parse($attendance->created_at)->format('d/m/y - H:i:s') }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><b>Status</b></td>
                                            <td style="padding: 0 5px">:</td>
                                            <td>{{ strtoupper($attendance->status_attendance) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                        </div>
                    @endif
                @endforeach
            @endforeach
        </div>
    @endunless

    @if ($this->permission)
        <div class="d-flex flex-wrap flex-column justify-content-center">
            @foreach ($this->rows as $row)
                @foreach ($row->permissions as $permission)
                    <div class="d-flex mb-1 mt-3 pb-5 pt-3 border-bottom">
                        <div class="order-item">
                            <table style="font-size: 13px; color: #000">
                                <tr>
                                    <td colspan="2">
                                        <p class="fs-7 fw-bolde">{{ strtoupper($permission->status_permission) }}</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 40%"><b>Keterangan</b></td>
                                    <td style="padding: 0 20px">:</td>
                                    <td class="pb-3" style="width: 50%">{{ $permission->information }}</td>
                                </tr>

                                <tr>
                                    <td style="width: 40%"><b>Tanggal Pengajuan</b></td>
                                    <td style="padding: 0 20px">:</td>
                                    <td style="width: 50%">
                                        {{ Carbon\Carbon::parse($permission->created_at)->format('d/m/Y - H:i:s') }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 40%"><b>Batas Perizinan</b></td>
                                    <td style="padding: 0 20px">:</td>
                                    <td style="width: 50%">
                                        {{ Carbon\Carbon::parse($permission->date_start)->format('d/m/Y') }}
                                        -
                                        {{ Carbon\Carbon::parse($permission->date_end)->format('d/m/Y') }}</td>
                                </tr>

                                <tr>
                                    <td style="width: 40%" class="pt-3"><b>File / Surat</b></td>
                                    <td style="padding: 0 20px"></td>
                                    <td style="width: 50%"><a class="btn btn-sm btn-dark"
                                            href="/{{ $permission->file }}"><span class="las la-eye"></span></a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    @endif
</div>
