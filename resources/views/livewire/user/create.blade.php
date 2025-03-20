<div>
    <x-slot name="title">Tambah Pengguna</x-slot>
    <x-slot name="pageTitle">Tambah Pengguna</x-slot>
    <x-slot name="pagePretitle">Menambah pengguna.</x-slot>

    <x-slot name="button">
        <a href="{{ route('user.index') }}" class="btn btn-sm tf-btn primary"><span class="las la-arrow-left"></span>
            Kembali</a>
    </x-slot>

    <x-alert />

    <form wire:submit.prevent='save' autocomplete="off">
        <div class="d-flex justify-content-center">
            @if ($this->avatar)
                <img style="width: 80px;height:80px; object-fit:cover;" class="rounded-circle"
                    src="{{ $this->avatar->temporaryUrl() }}" alt="img">
            @endif
        </div>

        <x-backend.form.input wire:model.lazy='avatar' label="Avatar / Foto" name="avatar" type="file" />

        <x-backend.form.input wire:model='namaLengkap' label="Nama Lengkap" name="namaLengkap" type="text"
            placeholder="masukkan nama lengkap" autofocus required />

        <x-backend.form.input wire:model='username' label="Username" name="username" type="text"
            placeholder="masukkan username" required />

        <x-backend.form.input wire:model='surel' label="Alamat Surel (email)" name="surel" type="email"
            placeholder="contoh@gmail.com" required />

        <x-backend.form.input wire:model='kataSandi' label="Kata Sandi" name="kataSandi" type="password"
            placeholder="*********" required />

        <x-backend.form.input wire:model='konfirmasiKataSandi' label="Konfirmasi Kata Sandi" name="konfirmasiKataSandi"
            type="password" placeholder="*********" required />

        <x-backend.form.select wire:model='roles' name="roles" label="Pilih Level">
            <option value="">- pilih -</option>
            @foreach (config('const.roles') as $role)
                <option value="{{ $role }}">{{ $role }}</option>
            @endforeach
        </x-backend.form.select>

        <x-backend.button.save name="Simpan" target="save" />
    </form>
</div>
