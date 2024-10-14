<div>
    @if (session('alert'))
        <div class="alert alert-{{ $type }} light alert-dismissible fade show mb-10" role="alert">

            @switch($type)
                @case('success')
                    <x-icon.alert.success />
                @break

                @case('info')
                    <x-icon.alert.info />
                @break

                @case('warning')
                    <x-icon.alert.warning />
                @break

                @case('danger')
                    <x-icon.alert.danger />
                @break
            @endswitch

            <span>{{ $detail, $message }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <i class="icon-close"></i>
            </button>
        </div>
    @endif
</div>
