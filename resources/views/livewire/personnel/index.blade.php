<div>
    <x-slot name="title">Personnel</x-slot>
    <x-slot name="pageTitle">Personnel</x-slot>
    <x-slot name="pagePretitle">Daftar personnel.</x-slot>

    <x-slot name="button">
        <a href="{{ route('personnel.create') }}" class="btn btn-sm tf-btn primary">Tambah</a>
    </x-slot>

    <x-alert />

    @forelse ($this->rows as $row)
        <div class="order-item mb-2 mt-3">
            <div class="img">
                <img src="{{ $row->akun->avatarUrl() }}" alt="img">
            </div>
            <div class="content">

                <div class="left">
                    <h6>{{ $row->name }}</h6>
                    <p class="text-black mt-8"><b>NIP :</b> {{ $row->nip }}</p>
                    <p class="text-black mt-8"><b>NRP :</b> {{ $row->nrp }}</p>
                </div>

                <span class="price">
                    <div class="d-flex flex-wrap">
                        <a wire:click="delete({{ $row->id }})"
                            wire:confirm="Apakah anda yakin ingin menghapus? apa yang anda lakukan tidak adapat di kembalikan."
                            class="btn btn-sm btn-danger me-2">Hapus</a>

                        <a href="{{ route('personnel.edit', $row->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    </div>
                </span>
            </div>
        </div>
    @empty
        <x-datatable.empty />
    @endforelse
</div>
