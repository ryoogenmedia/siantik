<x-layouts.blank>
    <div class="empty">
        <div class="pt-5">
            <h1 class="empty-header">404</h1>
            <h2 class="empty-title">Data Tidak Ada</h2>
        </div>

        <p class="empty-subtitle text-muted">
            @if ($exception->getMessage())
                <h5>{{ $exception->getMessage() }}</h5>
            @else
                Data yang anda cari tidak ada
            @endif
        </p>

        <div class="empty-action pt-4 mx-5">
            <a href="javascript:history.back()" class="btn-sm tf-btn primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                    <line x1="5" y1="12" x2="11" y2="18" />
                    <line x1="5" y1="12" x2="11" y2="6" />
                </svg>
                Kembali
            </a>
        </div>
    </div>
</x-layouts.blank>
