<x-layouts.auth title="Masuk">
    <div class="card card-md">
        <div class="card-body">
            <div class="text-center">Akun Anda dinonaktifkan</div>

            <div class="p-3 mb-3 bg-blue-lt ">
                <div class="row justify-content-center">
                    <div class="col-2">
                        <img src="{{ auth()->user()->avatarUrl() }}" alt="foto {{ auth()->user()->name }}"
                            class="rounded-circle me-2" width="50px">
                    </div>

                    <div class="col-6">
                        <span>{{ auth()->user()->name }}</span> <br>
                        <small class="text-muted">{{ auth()->user()->email }}</small>
                    </div>
                </div>
            </div>

            <div class="alert alert-warning mt-5">
                Akun anda sedang dinonaktifkan oleh admin. Silahkan kontak administrator untuk informasi lebih lanjut.
            </div>

            <form method="POST" action="{{ route('logout') }}" class="text-center">
                @csrf

                <button type="submit" class="btn btn-danger">
                    Keluar
                </button>
            </form>
        </div>
    </div>
</x-layouts.auth>
