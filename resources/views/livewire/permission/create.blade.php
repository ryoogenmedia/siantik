<div>
    <x-slot name="title">Tambah Perizinan</x-slot>
    <x-slot name="pageTitle">Tambah Perizinan</x-slot>
    <x-slot name="pagePretitle">Menambah Perizinan.</x-slot>

    <x-slot name="button">
        <a href="{{ route('permission.index') }}" class="btn btn-sm tf-btn primary">Kembali</a>
    </x-slot>

    <x-alert />

    <form wire:submit.prevent='save' autocomplete="off">
        <x-backend.form.select wire:model.lazy='roles' name="roles" label="Pilih Jenis Akun" required>
            <option value="">- pilih -</option>
            @foreach (config('const.roles') as $role)
                @if ($role != 'superadmin' && $role != 'admin')
                    <option value="{{ $role }}">{{ $role == 'leader' ? 'pimpinan' : 'personil' }}</option>
                @endif
            @endforeach
        </x-backend.form.select>

        @if ($this->roles)
            <x-backend.form.select wire:model.lazy='pengguna' name="pengguna" label="Pilih Pengguna" required>
                <option value="">- pilih -</option>
                @foreach ($this->listUser as $data)
                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                @endforeach
            </x-backend.form.select>
        @endif

        @if ($this->pengguna)
            <x-backend.form.select wire:model.lazy='statusIzin' name="statusIzin" label="Keterangan" required>
                <option value="">- pilih -</option>
                @foreach (config('const.category_attendance') as $attendance)
                    @if ($this->roles == 'leader')
                        @if ($attendance != 'terlambat')
                            <option value="{{ $attendance }}">{{ ucwords($attendance) }}</option>
                        @endif
                    @else
                        @if ($attendance != 'hadir' && $attendance != 'terlambat')
                            <option value="{{ $attendance }}">{{ ucwords($attendance) }}</option>
                        @endif
                    @endif
                @endforeach
            </x-backend.form.select>

            <x-backend.form.input wire:model='fileIzin' label="File Izin (Surat, Dokumen) (PDF, JPG, PNG)"
                name="fileIzin" type="file" />

            <x-backend.form.input wire:model='tanggalAwal' label="Tanggal Awal" name="tanggalAwal" type="date" />

            <x-backend.form.input wire:model='tanggalAkhir' label="Tanggal Akhir" name="tanggalAkhir" type="date" />

            <h6 class="mt-5 mb-3 text-muted text-center">- DATA PENGGUNA -</h6>

            <div class="d-flex justify-content-center">
                @if ($this->avatarUrl)
                    <img style="width: 80px;height:80px; object-fit:cover;" class="rounded-circle"
                        src="{{ $this->avatarUrl }}" alt="img">
                @endif
            </div>

            @if ($this->nip && $this->nrp && $this->jabatan)
                <x-backend.form.input wire:model='nip' label="NIP" name="nip" type="text" placeholder="nip"
                    disabled />

                <x-backend.form.input wire:model='nrp' label="NRP" name="nrp" type="text" placeholder="nrp"
                    disabled />

                <x-backend.form.input wire:model='jabatan' label="Jabatan" name="jabatan" type="text"
                    placeholder="jabatan" disabled />
            @endif

            <x-backend.form.input wire:model='namaPengguna' label="Nama Lengkap" name="namaPengguna" type="text"
                placeholder="masukkan nama lengkap" required />
        @endif

        <x-backend.button.save name="Simpan" target="save" />
    </form>
</div>
