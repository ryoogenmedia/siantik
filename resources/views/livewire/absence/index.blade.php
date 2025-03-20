@push('styles')
    <style>
        body {
            overflow: hidden;
        }

        video {
            width: 50vw;
            height: 50vh;
            object-fit: cover;
        }
    </style>
@endpush

<div wire:poll.10s>
    <x-slot name="title">Presensi</x-slot>
    <x-slot name="pageTitle">Presensi</x-slot>
    <x-slot name="pagePretitle">Melakukan presensi.</x-slot>

    <x-alert />

    @if ($this->checkAbsence)
        <div class="row">
            <video id="vid" autoplay playsinline></video>
        </div>

        <button class="btn tf-btn primary mt-3" onclick="takePicture()" {{ $this->inRadius ? '' : 'disabled' }}>Rekam
            Presensi</button>
    @else
        @if (!$this->isCheckOut && !$this->isPermit)
            <div class="row">
                <div class="card">
                    <div class="card-body text-center">
                        <h6>Anda sudah presensi.</h6>
                        <p class="text-muted" style="font-size:12px">Silakan melakukan presensi esok hari.</p>
                    </div>
                </div>
            </div>
        @else
            <p style="font-size: 14px">Tekan tombol untuk presensi pulang.</p>
            <button wire:click='absenceCheckOut' class="btn tf-btn success mt-3">Presensi Pulang</button>
        @endif
    @endif
</div>

@push('scripts')
    <script>
        document.addEventListener("livewire:load", function() {
            async function initializeVideoCapture() {
                try {
                    const videoElement = document.getElementById("vid");
                    if (!videoElement) {
                        console.error("Elemen video tidak ditemukan.");
                        return;
                    }

                    const stream = await navigator.mediaDevices.getUserMedia({
                        video: true
                    });
                    videoElement.srcObject = stream;
                } catch (error) {
                    alert("Error mengakses kamera: " + error.message);
                }
            }

            initializeVideoCapture();
        });
    </script>
@endpush
