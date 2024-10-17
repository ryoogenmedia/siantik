<div>
    <x-slot name="title">Tambah Personnel</x-slot>
    <x-slot name="pageTitle">Tambah Personnel</x-slot>
    <x-slot name="pagePretitle">Menambah personnel.</x-slot>

    <x-slot name="button">
        <a href="{{ route('personnel.index') }}" class="btn btn-sm tf-btn primary">Kemabali</a>
    </x-slot>

    <x-alert />

    <form wire:submit.prevent='save' autocomplete="off">
        <x-backend.form.input wire:model='namaLengkap' label="Nama Lengkap" name="namaLengkap" type="text"
            placeholder="masukkan nama lengkap" autofocus required />

        <x-backend.form.input wire:model='nip' label="NIP" name="nip" type="number"
            placeholder="masukkan nip" />

        <x-backend.form.input wire:model='nrp' label="NRP" name="nrp" type="number"
            placeholder="masukkan nrp" />

        <x-backend.form.select wire:model='jenisKelamin' name="jenisKelamin" label="Pilih Jenis Kelamin" required>
            <option value="">- pilih -</option>
            @foreach (config('const.sex') as $jenisKelamin)
                <option value="{{ $jenisKelamin }}">{{ $jenisKelamin }}</option>
            @endforeach
        </x-backend.form.select>

        <x-backend.form.input wire:model='jabatan' name='jabatan' type="text" label="Pilih Jabatan" required
            placeholder="Masukkan nama jabatan" />

        <p class="text-center fw-bold my-5">- DATA AKUN -</p>

        <div class="d-flex justify-content-center">
            @if ($this->avatar)
                <img style="width: 80px;height:80px; object-fit:cover;" class="rounded-circle"
                    src="{{ $this->avatar->temporaryUrl() }}" alt="img">
            @endif
        </div>

        <x-backend.form.input wire:model.lazy='avatar' label="Avatar / Foto" name="avatar" type="file" />

        <x-backend.form.input wire:model='surel' label="Alamat Surel (email)" name="surel" type="email"
            placeholder="contoh@gmail.com" required />

        <x-backend.form.input wire:model='kataSandi' label="Kata Sandi" name="kataSandi" type="password"
            placeholder="*********" required />

        <x-backend.form.input wire:model='konfirmasiKataSandi' label="Konfirmasi Kata Sandi" name="konfirmasiKataSandi"
            type="password" placeholder="*********" required />

        <x-backend.button.save name="Simpan" target="save" />
    </form>
</div>
