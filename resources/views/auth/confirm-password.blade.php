<x-layouts.auth title="Lupa Kata Sandi">
    <div class="card-body">
        <form class="mt-5" action="{{ route('password.confirm') }}" method="POST" autocomplete="off">
            @csrf
            <h4 class="text-center mb-5">Konfirmasi Kata Sandi</h4>

            <fieldset class="mb-3">
                <input class="form-control"
                name="password"
                type="password"
                placeholder="******"
                autocomplete="current-password"
                required>
            </fieldset>

            <button type="submit" class="mt-4 tf-btn primary">Konfirmasi</button>

        </form>
    </div>
</x-layouts.auth>
