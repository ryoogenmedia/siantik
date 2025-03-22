<div>
    <x-slot name="title">Riwayat Presensi</x-slot>

    <x-slot name="pagePretitle">Riwayat Presensi</x-slot>

    <x-slot name="pageTitle">Riwayat Presensi</x-slot>

    <div class="d-flex flex-wrap flex-column">
        @foreach ($this->attendances as $attendance)
            @if (in_array($attendance->status_attendance, config('const.presensi_status')))
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
                                    <td><b>Waktu</b></td>
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
                                    <td><b>Waktu</b></td>
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
    </div>
</div>
