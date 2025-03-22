<div>
    <x-slot name="title">Riwayat Presensi</x-slot>

    <x-slot name="pagePretitle">Riwayat Presensi</x-slot>

    <x-slot name="pageTitle">Riwayat Presensi</x-slot>

    <div class="d-flex flex-wrap flex-column justify-content-center">
        @foreach ($this->permissions as $permission)
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
                                {{ Carbon\Carbon::parse($permission->created_at)->format('d/m/Y - H:i:s') }}</td>
                        </tr>

                        <tr>
                            <td style="width: 40%"><b>Batas Perizinan</b></td>
                            <td style="padding: 0 20px">:</td>
                            <td style="width: 50%">{{ Carbon\Carbon::parse($permission->date_start)->format('d/m/Y') }}
                                -
                                {{ Carbon\Carbon::parse($permission->date_end)->format('d/m/Y') }}</td>
                        </tr>

                        <tr>
                            <td style="width: 40%" class="pt-3"><b>File / Surat</b></td>
                            <td style="padding: 0 20px"></td>
                            <td style="width: 50%"><a class="btn btn-sm btn-dark" href="/{{ $permission->file }}"><span
                                        class="las la-eye"></span></a></td>
                        </tr>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
</div>
