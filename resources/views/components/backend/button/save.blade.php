<button type="submit" class="btn tf-btn btn-primary my-3 {{ $class ?? '' }}" wire:loading.attr="disabled">
    <span wire:loading.remove wire:target="{{ $target }}">{{ $name ?? 'Simpan' }}</span>

    <span wire:loading wire:target="{{ $target }}">Memuat</span>

    <span class="animated-dots" wire:loading wire:target="{{ $target }}"></span>
</button>
