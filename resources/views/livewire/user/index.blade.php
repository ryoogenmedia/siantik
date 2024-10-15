<div>
    <x-slot name="title">Pengguna</x-slot>
    <x-slot name="pageTitle">Pengguna</x-slot>
    <x-slot name="pagePretitle">Daftar pengguna.</x-slot>

    <x-slot name="button">
        <a href="{{ route('user.create') }}" class="btn btn-sm tf-btn primary">Tambah</a>
    </x-slot>

    <x-alert />

    @forelse ($this->rows as $row)
        <div class="order-item mb-2 mt-3">
            <div class="img">
                <img src="{{ $row->avatarUrl() }}" alt="img">
            </div>
            <div class="content">
                <div class="left">
                    <h6 style="font-size: 12px">{{ $row->name }}</h6>
                    <p class="text-black" style="font-size: 12px">{{ strtolower($row->roles) }}</p>
                </div>
                <span class="price">
                    <div class="d-flex flex-wrap">
                        @if ($row->id != auth()->user()->id)
                            <a wire:click="delete({{ $row->id }})"
                                wire:confirm="Apakah anda yakin ingin menghapus? apa yang anda lakukan tidak adapat di kembalikan."
                                class="btn btn-sm btn-danger me-2" style="font-size: 12px">Hapus</a>
                        @endif

                        <a href="{{ route('user.edit', $row->id) }}" class="btn btn-sm btn-primary"
                            style="font-size: 12px">Edit</a>
                    </div>
                </span>
            </div>
        </div>
    @empty
        <x-datatable.empty />
    @endforelse
</div>
