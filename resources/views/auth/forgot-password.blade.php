<x-layouts.auth title="Lupa Kata Sandi">
    <div class="card-body">
    <form class="mt-5" action="{{ route('password.email') }}" method="POST" autocomplete="off">
        @csrf
            <h4 class="text-center mb-5">Lupa Kata Sandi</h4>

        <div class="alert alert-warning light alert-dismissible fade show mb-5 mt-5 ">
            Lupa kata sandi Anda? Tidak masalah. Beri tahu kami alamat email Anda dan kami akan mengirimkan email berisi
            tautan pengaturan ulang kata sandi yang memungkinkan Anda memilih yang baru.
        </div>

        <fieldset class="mb-3">
            <label for="email">Alamat Surel (Email)</label>
            <input id="email" name="email" type="email" placeholder="contoh@gmail.com" class="form-control"
                value="{{ old('email') }}" required autofocus>
        </fieldset>

        <button type="submit" class="mt-4 tf-btn primary">Send me new password</button>
    </form>
    <div class="text-center mt-3 text-dark">
        Batal, <a href="{{ route('login') }}">arahkan saya kembali</a> ke halaman masuk.
    </div>
</div>
</x-layouts.auth>
