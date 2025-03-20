<div>
    <x-slot name="title">Riwayat Presensi</x-slot>
    <x-slot name="pageTitle">Riwayat Presensi</x-slot>
    <x-slot name="pagePretitle">Daftar riwayat presensi.</x-slot>

    <x-alert />

    @forelse ($this->rows as $row)
        <div class="order-item my-1 border-bottom pb-3">
            <div class="img d-flex">
                <img class="m-auto" style="width: 50px; height: 50px; object-fit: cover; border-radius: 100%"
                    src="{{ $row->imageUrl() }}" alt="Foto presensi {{ $row->akun->name }}">
            </div>
            <div class="content w-100">
                <h6 class="fw-bold mb-2" style="font-size: 12px">
                    {{ ucwords(strtolower($row->akun->name)) }}
                </h6>
                <table style="width: 100%;">
                    <tr>
                        <td style="font-size: 10px;"><b>Presensi Masuk</b></td>
                        <td style="font-size: 10px; padding: 0 10px;">:</td>
                        <td style="font-size: 10px;">
                            <b>{{ Carbon\Carbon::parse($row->check_in)->diffForHumans() ?? 'tidak ada waktu' }}</b>
                            <span class="py-1 px-2 ms-2 d-inline rounded-2"
                                style="font-size: 10px; font-weight: bold;
                                background-color: {{ $row->status_check_in == 'tepat waktu' ? '#bfffb9' : '#ffb9b9' }};
                                color: {{ $row->status_check_in == 'tepat waktu' ? '#41a722' : '#a72222' }};">
                                {{ $row->status_check_in }}
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td style="font-size: 10px;"><b>Presensi Pulang</b></td>
                        <td style="font-size: 10px; padding: 0 10px;">:</td>
                        <td style="font-size: 10px;">
                            <b>{{ Carbon\Carbon::parse($row->check_out)->diffForHumans() ?? 'tidak ada waktu' }}</b>
                            <span class="py-1 px-2 ms-2 d-inline rounded-2"
                                style="font-size: 10px; font-weight: bold;
                                background-color: {{ $row->status_check_out == 'tepat waktu' ? '#bfffb9' : '#ffb9b9' }};
                                color: {{ $row->status_check_out == 'tepat waktu' ? '#41a722' : '#a72222' }};">
                                {{ $row->status_check_out }}
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td style="font-size: 10px;"><b>Keterangan</b></td>
                        <td style="font-size: 10px; padding: 0 10px;">:</td>
                        <td style="font-size: 10px;">
                            <span class="py-1 px-2 d-inline rounded-2"
                                style="font-size: 10px; font-weight: bold;
                                background-color: {{ $row->status_attendance == 'hadir' ? '#bfffb9' : '#ffb9b9' }};
                                color: {{ $row->status_attendance == 'hadir' ? '#41a722' : '#a72222' }};">
                                {{ $row->status_attendance }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    @empty
        <x-datatable.empty />
    @endforelse
</div>
