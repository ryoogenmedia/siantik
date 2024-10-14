<div wire:ignore class="modal fade action-sheet full" id="{{ $target }}">
    <div class="modal-dialog" role="document">
        <div class="modal-up">
            <div class="top line-bt">
                <div class="inner">
                    <h3>{{ $title ?? 'Filter' }}</h3>
                    <span class="icon-close1" data-bs-dismiss="modal"></span>
                </div>
            </div>

            <div class="tf-container">
                {{ $slot }}
            </div>

            <div class="footer-fixed p-16 line-top d-flex gap-8">
                <button wire:click='resetFilter' type="reset" class="tf-btn surface del-cartAll"
                    data-bs-dismiss="modal">Reset Filter</button>
                <button wire:click='filterActive' class="tf-btn primary" data-bs-dismiss="modal">Terapkan</button>
            </div>
        </div>
    </div>
</div>
