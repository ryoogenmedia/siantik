<div>
    <x-slot name="title">Perizinan</x-slot>
    <x-slot name="pageTitle">Perizinan</x-slot>
    <x-slot name="pagePretitle">Daftar izin personnel & pimpinan.</x-slot>

    <x-slot name="button">
        <a href="{{ route('permission.create') }}" class="btn btn-sm tf-btn primary">Tambah</a>
    </x-slot>

    <x-alert />

    @forelse ($this->rows as $row)
        <div class="order-item mb-2 mt-3">
            <div class="img">
                <img src="{{ $row->akun->avatarUrl() }}" alt="img">
            </div>
            <div class="content">

                <div class="left">
                    <h6 style="font-size: 12px">{{ $row->akun->name }}</h6>
                    <p class="text-black" style="font-size: .8rem"><b>waktu :</b>
                        {{ $row->created_at->format('d-m-Y H:i:s') }}</p>
                    <p class="text-black" style="font-size: .8rem"><b>status :</b>
                        {{ $row->status_permission }}</p>
                    <p><span class="bg-{{ $row->akun->roles == 'leader' ? 'success' : 'primary' }} text-white rounded-2 px-2"
                            style="font-size: 12px">{{ $row->akun->roles == 'leader' ? 'Pimpinan' : 'Personel' }}</span>
                    </p>
                </div>

                <span class="price">
                    <div class="d-flex flex-wrap">
                        @if ($row->file)
                            <a class="btn btn-sm btn-dark me-1" target="_blank"
                                href="{{ asset('storage/' . $row->file) }}">File</a>
                        @endif

                        <a wire:click="delete({{ $row->id }})"
                            wire:confirm="Apakah anda yakin ingin menghapus? apa yang anda lakukan tidak adapat di kembalikan."
                            class="btn btn-sm btn-danger me-1" style="font-size: 12px">Hapus</a>

                        <a href="{{ route('permission.edit', $row->id) }}" class="btn btn-sm btn-primary mt-4"
                            style="font-size: 12px">Edit</a>
                    </div>
                </span>
            </div>
        </div>
    @empty
        <x-datatable.empty />
    @endforelse
</div>
