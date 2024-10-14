<div class="line4-bt pt-16 pb-16">
    <div class="tf-container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5>{{ $pageTitle }}</h5>
                <p class="small">{{ $pagePretitle }}</p>
            </div>

            @isset($button)
                <div style="width: 120px;">
                    {{ $button ?? '' }}
                </div>
            @endisset
        </div>
    </div>
</div>
