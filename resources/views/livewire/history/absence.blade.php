<div>
    <x-slot name="title">Riwayat Presensi</x-slot>
    <x-slot name="pageTitle">Riwayat Presensi</x-slot>
    <x-slot name="pagePretitle">Daftar riwayat presensi.</x-slot>

    <x-alert />

    @forelse ($this->rows as $row)
        <div class="order-item mb-2 mt-3">
            <div class="img">
                <img src="{{ asset($row->image) }}" alt="img">
            </div>
            <div class="content">
                <div class="left">
                    <h6 class="fw-bold mb-2" style="font-size: 14px">{{ $row->akun->name }}</h6>
                    <table>
                        <tr>
                            <td>
                                <p class="text-black" style="font-size: .8rem"><b>presensi masuk</b>
                            </td>
                            <td>
                                <p class="text-black px-3" style="font-size: .8rem"><b>:</b>
                            </td>
                            <td>
                                <p class="text-black" style="font-size: .8rem"><b>{{ $row->check_in }}</b>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p class="text-black" style="font-size: .8rem"><b>presensi pulang</b>
                            </td>
                            <td>
                                <p class="text-black px-3" style="font-size: .8rem"><b>:</b>
                            </td>
                            <td>
                                <p class="text-black" style="font-size: .8rem"><b>{{ $row->check_out }}</b>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p class="text-black" style="font-size: .8rem"><b>keterangan</b>
                            </td>
                            <td>
                                <p class="text-black px-3" style="font-size: .8rem"><b>:</b>
                            </td>
                            <td>
                                <p class="text-black" style="font-size: .8rem"><b>{{ $row->status_attendance }}</b>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    @empty
        <x-datatable.empty />
    @endforelse
</div>
