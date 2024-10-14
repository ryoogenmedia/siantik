<div>
    <x-slot name="title">Beranda</x-slot>
    <x-slot name="pageTitle">Dashboard</x-slot>
    <x-slot name="pagePretitle">Ringkasan aplikasi anda berada disini.</x-slot>

    @if (auth()->user()->roles == 'superadmin')
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header text-primary">Jumlah Pengguna</div>
                    <div class="card-body">
                        <h3>{{ $this->jmlPengguna }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card">
                    <div class="card-header text-primary">Jumlah Personnel</div>
                    <div class="card-body">
                        <h3>{{ $this->jmlPersonnel }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-primary">Radius Lingkaran Absensi</div>
                    <div class="card-body">
                        <h3>{{ $this->radiusLingkaran }}</h3>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
