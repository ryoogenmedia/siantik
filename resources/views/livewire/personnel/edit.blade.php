<div>
    <x-slot name="title">Sunting Personil</x-slot>
    <x-slot name="pageTitle">Sunting Personil</x-slot>
    <x-slot name="pagePretitle">Menyunting Personil.</x-slot>

    <x-slot name="button">
        <a href="{{ route('personnel.index') }}" class="btn btn-sm tf-btn primary"><span
                class="las la-arrow-left me-1"></span>Kembali</a>
    </x-slot>

    <x-alert />

    <form wire:submit.prevent='save' autocomplete="off">
        <x-backend.form.input wire:model='namaLengkap' label="Nama Lengkap" name="namaLengkap" type="text"
            placeholder="masukkan nama lengkap" autofocus required />

        <x-backend.form.input wire:model='nomorIdentitas' label="Nomor Identitas (NIP / NRP)" name="nomorIdentitas"
            type="number" placeholder="masukkan nip / nrp" required />

        <x-backend.form.select wire:model='jenisKelamin' name="jenisKelamin" label="Pilih Jenis Kelamin" required>
            <option value="">- pilih -</option>
            @foreach (config('const.sex') as $jenisKelamin)
                <option value="{{ $jenisKelamin }}">{{ $jenisKelamin }}</option>
            @endforeach
        </x-backend.form.select>

        <x-backend.form.input wire:model='jabatan' name='jabatan' type="text" label="Jabatan" required
            placeholder="Masukkan nama jabatan" />

        <hr class="mt-5">

        <div class="d-flex justify-content-center">
            @if ($this->avatar)
                <img style="width: 80px;height:80px; object-fit:cover;" class="rounded-circle mt-3"
                    src="{{ $this->avatar->temporaryUrl() }}" alt="img">
            @else
                <img style="width: 80px;height:80px; object-fit:cover;" class="rounded-circle mt-3"
                    src="{{ $this->avatarUrl }}" alt="img">
            @endif
        </div>

        <x-backend.form.input wire:model.lazy='avatar' label="Avatar / Foto" name="avatar" type="file" />

        <x-backend.form.input wire:model='surel' label="Alamat Surel (email)" name="surel" type="email"
            placeholder="contoh@gmail.com" optional="Abaikan jika tidak ingin mengubah." />

        <x-backend.form.input wire:model='kataSandi' label="Kata Sandi" name="kataSandi" type="password"
            placeholder="*********" optional="Kosongkan jika tidak ingin mengubah." />

        <x-backend.form.input wire:model='konfirmasiKataSandi' label="Konfirmasi Kata Sandi" name="konfirmasiKataSandi"
            type="password" placeholder="*********" optional="Kosongkan jika tidak ingin mengubah." />

        <x-backend.button.save name="Simpan" target="save" />
    </form>

</div>
