<div>
    <x-slot name="title">Personil</x-slot>
    <x-slot name="pageTitle">Personil</x-slot>
    <x-slot name="pagePretitle">Daftar Personil.</x-slot>

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
                <div class="left" style="width: 50%">
                    <h6 class="fw-bold mb-2" style="font-size: 14px">{{ $row->name }}</h6>
                    <table>
                        <tr>
                            <td>
                                <p class="text-black fw-bold" style="font-size: 12px">NIP / NRP</p>
                            </td>
                            <td>
                                <p class="text-black px-1 fw-bold" style="font-size: 12px">:</p>
                            </td>
                            <td>
                                <p class="text-black" style="font-size: 12px">{{ $row->number_identity }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="text-black fw-bold" style="font-size: 12px">Alamat Surel</p>
                            </td>
                            <td>
                                <p class="text-black px-1 fw-bold" style="font-size: 12px">:</p>
                            </td>
                            <td>
                                <p class="text-black" style="font-size: 12px">{{ $row->akun->email }}</p>
                            </td>
                        </tr>
                    </table>
                </div>

                <span class="price">
                    <div class="d-flex flex-wrap">
                        <a wire:click="delete({{ $row->id }})"
                            wire:confirm="Apakah anda yakin ingin menghapus? apa yang anda lakukan tidak adapat di kembalikan."
                            class="btn btn-sm btn-danger me-2" style="font-size: 12px">Hapus</a>

                        <a href="{{ route('personnel.edit', $row->id) }}" class="btn btn-sm btn-primary"
                            style="font-size: 12px">Edit</a>
                    </div>
                </span>
            </div>
        </div>
    @empty
        <x-datatable.empty />
    @endforelse
</div>
