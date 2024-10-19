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
    <x-slot name="title">Absensi</x-slot>
    <x-slot name="pageTitle">Absensi</x-slot>
    <x-slot name="pagePretitle">Melakukan absensi.</x-slot>

    <x-alert />

    @if ($this->checkAbsence)
        <div class="row">
            <video class="relative" id="vid"></video>

            <div id="imageContainer" style="display: none;">
                <img id="capturedImage" style="width:100vw; height: 100vh; object-fit:cover" />
            </div>

            <div id="delayOverlay" class="delay-overlay"></div>

            <div class="overlay"></div>
        </div>

        <button class="btn tf-btn primary mt-3" onclick="takePicture()">Rekam Absensi</button>
    @else
        @if (!$this->isCheckOut && !$this->isPermit)
            <div class="row">
                <div class="card">
                    <div class="card-body text-center">
                        <h6>anda telah melakukan absensi atau telah di izinkan.</h6>
                        <p class="text-muted" style="font-size:12px">silahkan melakukan absensi esok hari.
                        </p>
                    </div>
                </div>
            </div>
        @else
            <p style="font-size: 14px">Pencet Tombol Untuk Absensi Pulang (Siang)</p>
            <button wire:click='absenceCheckOut' class="btn tf-btn success mt-3">Absensi Siang</button>
        @endif
    @endif
</div>


@push('scripts')
    <script>
        // COMPONENT
        let caputureAudio = document.getElementById('capture');
        let timerAudio = document.getElementById('delay');
        let delayOverlay = document.getElementById("delayOverlay");
        let video = document.getElementById("vid");
        let canvas = document.createElement("canvas");
        let capturedImage = document.getElementById("capturedImage");
        let imageContainer = document.getElementById("imageContainer");

        document.addEventListener("DOMContentLoaded", () => {
            initializeVideoCapture();
        });

        // TAKE PICTURE FUNCTION
        function takePicture() {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            let ctx = canvas.getContext("2d");
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
            let base64 = canvas.toDataURL();
            let imgJpeg = canvas.toDataURL('image/jpeg');
            capturedImage.src = base64;
            video.style.display = "none";

            Livewire.dispatch('takePicture', {
                'base_64': base64,
            });
        }

        function initializeVideoCapture() {
            let mediaDevices = navigator.mediaDevices;
            video.muted = true;

            mediaDevices
                .getUserMedia({
                    video: true,
                })
                .then((stream) => {
                    video.srcObject = stream;
                    video.style.transform = `scaleX(-1)`;
                    video.addEventListener("loadedmetadata", () => {
                        video.play();
                    });
                })
                .catch((error) => {
                    alert("Error accessing camera: " + error.message);
                    console.error("Camera access error: ", error);
                });
        }

        function getLatLon() {
            return new Promise((resolve, reject) => {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition((position) => {
                        let latitude = position.coords.latitude;
                        let longitude = position.coords.longitude;

                        resolve({
                            latitude,
                            longitude
                        });
                    }, (error) => {
                        reject(error);
                    });
                } else {
                    reject(new Error("Geolocation is not supported by this browser."));
                }
            });
        }

        getLatLon().then((coords) => {
            getLocationAbsence(coords.latitude, coords.longitude);
        }).catch((error) => {
            console.error("Gagal mendapatkan lokasi: ", error);
        });

        function getLocationAbsence(lat, lon) {
            var instLat = @this.instLatitude;
            var instLong = @this.instLongitude;
            var radius = @this.radius;

            var distanceToAbsence = calculateDistance(instLat, instLong, lat, lon);
            var distanceFromCircleEdge = distanceToAbsence - radius;

            distanceFromCircleEdge = Math.max(0, distanceFromCircleEdge);

            Livewire.dispatch('location', {
                distance: distanceFromCircleEdge,
                longitude: lon,
                latitude: lat
            });
        }

        function calculateDistance(lat1, lon1, lat2, lon2) {
            var R = 6371e3;
            var φ1 = lat1 * Math.PI / 180;
            var φ2 = lat2 * Math.PI / 180;
            var Δφ = (lat2 - lat1) * Math.PI / 180;
            var Δλ = (lon2 - lon1) * Math.PI / 180;

            var a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
                Math.cos(φ1) * Math.cos(φ2) *
                Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

            var d = R * c;
            return d;
        }
    </script>
@endpush
