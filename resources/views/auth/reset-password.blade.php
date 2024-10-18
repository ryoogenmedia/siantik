<x-layouts.auth title="Lupa Kata Sandi">
    <div class="card-body">
        <form class="mt-5" action="{{ route('password.update') }}" method="POST" autocomplete="off">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <h4 class="text-center mb-5">Reset Kata Sandi</h4>

            <fieldset class="mb-3">
                <label for="email">Alamat Surel (Email)</label>
                <input id="email" name="email" type="email" placeholder="contoh@gmail.com" class="form-control"
                    value="{{ old('email', $request->email) }}">
            </fieldset>

            <fieldset class="mb-3">
                <label class="form-label" for="password">Kata Sandi</label>
                <input class="form-control" type="password" name="password" placeholder="******" required
                    autocomplete="new-password">
            </fieldset>

            <fieldset class="mb-3">
                <label class="form-label" for="password_confirmation">Konfirmasi Kata Sandi</label>
                <input class="form-control" type="password" name="password_confirmation" placeholder="******" required
                    autocomplete="new-password">
            </fieldset>

            <button type="submit" class="mt-4 tf-btn primary"><i class="las la-redo-alt me-2"></i>
                <span>Reset</span>
            </button>
        </form>
    </div>
</x-layouts.auth>
