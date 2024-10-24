<x-layouts.blank>
    <div class="empty">
        <div class="mt-5">
            <h1 class="empty-header">403</h1>
            <h2 class="empty-title">Anda Tidak Memiliki Akses</h2>
        </div>

        <p class="empty-subtitle text-muted">
            @if ($exception->getMessage())
                <h5>{{ $exception->getMessage() }}</h5>
            @else
                Sesi anda telah habis kembali untuk login!
            @endif
        </p>

        <div class="empty-action">
            <a href="{{ route('mobile.logout') }}" class="btn btn-primary"
                onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                    <line x1="5" y1="12" x2="11" y2="18" />
                    <line x1="5" y1="12" x2="11" y2="6" />
                </svg>
                Login Kembali
            </a>
        </div>

        <form id="logout-form" action="{{ route('mobile.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</x-layouts.blank>
