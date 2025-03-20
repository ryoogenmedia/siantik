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
        </div>
    </div>

    <x-filter.card target="report-leader" title="Filter Laporan">
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

    <div class="table-responsive">
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th style="font-size: 10px">Foto</th>
                    <th style="font-size: 10px">Nama</th>
                    <th style="font-size: 10px">Presensi Masuk</th>
                    <th style="font-size: 10px">Presensi Pulang</th>
                    <th style="font-size: 10px">Keterangan</th>
                    <th style="font-size: 10px">Level</th>
                    <th style="font-size: 10px"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($this->rows as $row)
                    @foreach ($row->attendances as $attendance)
                        <tr>
                            <td><img style="width: 50px; height: 50px; border-radius: 100%; object-fit: cover"
                                    src="{{ asset($attendance->imageUrl()) }}" alt="img" width="50"></td>
                            <td style="font-size:10px">{{ $attendance->name }}</td>
                            <td style="font-size:10px; padding-right: 20px">{{ $attendance->check_in }}
                                <p> <span class="py-1 px-2 d-inline rounded-2"
                                        style="font-size: 10px; font-weight: bold;
                                    background-color: {{ $attendance->status_check_in == 'tepat waktu' ? '#bfffb9' : '#ffb9b9' }};
                                    color: {{ $attendance->status_check_in == 'tepat waktu' ? '#41a722' : '#a72222' }};">
                                        {{ $attendance->status_check_in == 'tepat waktu' ? 'tepat' : 'terlambat' }}
                                    </span></p>
                            </td>
                            <td style="font-size:10px; padding-right: 20px">
                                {{ $attendance->check_out ?? 'belum dilakukan' }}
                                @if ($attendance->check_out)
                                    <p>
                                        <span class="py-1 px-2 d-inline rounded-2"
                                            style="font-size: 10px; font-weight: bold;
                                        background-color: {{ $attendance->status_check_out == 'tepat waktu' ? '#bfffb9' : '#ffb9b9' }};
                                        color: {{ $attendance->status_check_out == 'tepat waktu' ? '#41a722' : '#a72222' }};">
                                            {{ $attendance->status_check_in == 'tepat waktu' ? 'tepat' : 'terlambat' }}
                                        </span>
                                    </p>
                                @endif
                            </td>
                            <td style="font-size:10px">{{ $attendance->status_attendance }}</td>
                            <td style="font-size:10px">
                                <span
                                    class="bg-{{ $attendance->akun->roles == 'leader' ? 'success' : 'primary' }} text-white rounded-2 px-2">
                                    {{ $attendance->akun->roles == 'leader' ? 'Pimpinan' : 'Personil' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('daily-report.leader-detail', ['id' => $attendance->id]) }}"
                                    class="btn btn-sm btn-dark"><span class="las la-eye"></span></a>
                            </td>
                        </tr>
                    @endforeach

                    @foreach ($row->permissions as $permission)
                        <tr>
                            <td><img src="{{ asset($permission->akun->avatarUrl()) }}" alt="img" width="50">
                            </td>
                            <td>{{ $permission->akun->name }}</td>
                            <td>{{ $permission->created_at->format('d-m-Y') }}</td>
                            <td>{{ $permission->created_at->format('H:i:s') }}</td>
                            <td>{{ $permission->status_permission }}</td>
                            <td>
                                <span
                                    class="bg-{{ $permission->akun->roles == 'leader' ? 'success' : 'primary' }} text-white rounded-2 px-2">
                                    {{ $permission->akun->roles == 'leader' ? 'Pimpinan' : 'Personil' }}
                                </span>
                            </td>
                            <td>-</td>
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
