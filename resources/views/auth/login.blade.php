<x-layouts.auth title="Login">
    <form class="mt-32" action="{{ route('login') }}" method="POST" autocomplete="off">

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

        <a href="reset-pass.html" class="text-caption d-inline-block text-secondary mt-12">Forgot Password?</a>
        <button type="submit" class="mt-32 tf-btn primary">Masuk</button>
    </form>
</x-layouts.auth>
