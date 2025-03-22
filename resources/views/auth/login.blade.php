<x-layouts.auth title="Login">
    <form class="mt-3" action="{{ route('login') }}" method="POST" autocomplete="off">
        <div class="text-center mb-5 pb-4">
            <h4 class="mb-1">Masuk Ke Aplikasi</h4>
            <p>Silahkan masukkan data akun anda untuk masuk.</p>
        </div>
        @csrf

        <fieldset>
            <label>Alamat Surel (email)</label>
            <input name="email" type="email" placeholder="contoh@gmail.com" class="form-control"
                value="{{ old('email') }}">
        </fieldset>

        <fieldset class="mt-12">
            <label>Kata Sandi</label>
            <div class="box-view-hide">
                <input name="password" type="password" placeholder="********" class="form-control password-field">
                <x-icon.box-hide />
            </div>
        </fieldset>

        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-caption d-inline-block text-secondary mt-12">Forgot
                Password?</a>
        @endif
        <button type="submit" class="mt-32 tf-btn primary">Masuk</button>
    </form>
</x-layouts.auth>
