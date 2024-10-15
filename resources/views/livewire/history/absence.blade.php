<div>
    <x-slot name="title">Riwayat Absensi</x-slot>
    <x-slot name="pageTitle">Riwayat Absensi</x-slot>
    <x-slot name="pagePretitle">Daftar riwayat absensi.</x-slot>

    <x-alert />

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

                    <p class="text-black" style="font-size: .8rem"><b>status :</b>
                        {{ $row->status_attendance }}</p>
                </div>
            </div>
        </div>
    @empty
        <x-datatable.empty />
    @endforelse
</div>
