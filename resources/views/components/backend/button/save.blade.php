<div class="footer-fixed p-16 mt-10">
    <button type="submit" class="btn tf-btn primary my-3 {{ $class ?? '' }}" wire:loading.attr="disabled">
        <span wire:loading.remove wire:target="{{ $target }}">{{ $name ?? 'Simpan' }}</span>

        <span wire:loading wire:target="{{ $target }}">Memuat</span>

        <span class="animated-dots" wire:loading wire:target="{{ $target }}"></span>
    </button>
</div>
