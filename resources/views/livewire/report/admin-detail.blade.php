@once
    @section('styles')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
            integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

        <link rel="stylesheet" type="text/css"
            href="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.css">

        <style>
            #map {
                height: 400px;
            }
        </style>
    @endsection
@endonce

<div>
    <x-slot name="title">Detail Absensi</x-slot>

    <x-slot name="pagePretitle">Detail Data Absensi</x-slot>

    <x-slot name="pageTitle">Detail Absensi</x-slot>

    <x-slot name="button">
        <x-datatable.button.back name="Kembali" :route="route('attendance.absence.index')" />
    </x-slot>

    <x-alert />

    <div class="card" wire:submit.prevent="save" autocomplete="off">
        <div class="card-header">
            Detail Absence
        </div>

        <div class="card-body">
            <div class="row">
                @if (isset($this->imageAbsence))
                    <div class="col-lg-5 col-12">
                        <img class="rounded-md" src="{{ asset($this->imageAbsence) }}"
                            alt="absensi-pengguna-{{ $this->personnelName }}">
                    </div>
                @endif

                <div class="col-lg-7 col-12">
                    <div class="mt-lg-0 mt-3">
                        <h4 class="mb-2">Nama</h4>
                        <p class="mb-2">{{ $this->personnelName }}</p>
                        <hr class="my-0 mt-3">
                    </div>

                    <div class="mt-3">
                        <h4 class="mb-2">Waktu Masuk</h4>
                        <p class="mb-2"><b>{{ \Carbon\Carbon::parse($this->date)->format('H:i') }}</b> |
                            {{ \Carbon\Carbon::parse($this->date)->format('d/m/Y') }}</p>
                        <p class="mb-2"> <span @class([
                            'badge',
                            'bg-success-lt' => $this->status == 'tepat waktu',
                            'bg-red-lt' => $this->status == 'terlambat',
                            'bg-danger' => $this->status == 'alfa',
                            'bg-orange-lt' => $this->status == 'izin',
                        ])>
                                {{ $this->status }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            Detail Lokasi Absensi
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-12" id="map"></div>
            </div>
        </div>

        <div class="card-body">
            Hasil Komparasi
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-lg-3">
                    <div class="mb-4">
                        <p class="mb-1">Radius Lembaga</p>
                        <p class="mb-2">Radius Lingkaran : <b>{{ $this->radiusLingkaran ?? '0' }}</b></p>
                        <div style="width: 100px; height: 10px; background-color: #500A94"></div>
                    </div>

                    <div>
                        <p class="mb-1">Jarak Dari Titik Lembaga</p>
                        <p class="mb-2">Panjang Garis : <b id="distanceToAbsence"></b></p>
                        <div style="width: 100px; height: 10px; background-color: #E54043"></div>
                    </div>
                </div>

                <div class="col-9">
                    <div class="row">
                        <div class="col-12">
                            <h4>Kesimpulan</h4>
                            <p id="distanceFromCircleEdge"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

    <script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet/0.0.1-beta.5/esri-leaflet.js"></script>

    <script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.js"></script>

    <script>
        document.addEventListener('livewire:init', () => {
            function getLatLon() {
                return new Promise((resolve, reject) => {
                    let latitude = @this.institutionLat;
                    let longitude = @this.institutionLng;

                    resolve({
                        latitude,
                        longitude
                    });
                });
            }

            getLatLon().then((coords) => {
                initMap(coords.latitude, coords.longitude);
            }).catch((error) => {
                console.error("Gagal mendapatkan lokasi: ", error);
                initMap({{ $this->institutionLat ?? -5.155978984099238 }},
                    {{ $this->institutionLng ?? 119.40353393554689 }});
            });

            function initMap(lat, lon) {
                var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                });

                var institutionLocation = L.latLng(lat, lon);
                var absenceLocation = L.latLng(@this.absenceLat, @this.absenceLng);
                var comparationLatLang = [institutionLocation, absenceLocation];

                var univIcon = L.icon({
                    iconUrl: @this.institutionLogo,
                    iconSize: [38, 38],
                });

                var popupInstitution = `<table cellpadding="5">
                <tr>
                    <td class="text-center" colspan="3"><img class="rounded-circle" width="50" height="50" style="object-fit: cover;" src='${@this.institutionLogo}' alt='gambar-kost'/></td>
                </tr>
                <tr>
                    <td class="text-center"><b>${@this.institutionName}</b></td>
                </tr>
                <tr>
                    <td class="text-center">Universitas Teknologi Akba Makassar</td>
                </tr>
                <tr>
                    <td class="text-center">${@this.institutionAddress}</td>
                </tr>
            </table>`;

                var popupAbsence = `<table cellpadding="5">
                <tr>
                    <td class="text-center" colspan="3"><img class="rounded-circle" width="50" height="50" style="object-fit: cover;" src='${@this.absenceImg}' alt='gambar-kost'/></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><b>${@this.personnelName}</b></td>
                </tr>
                <tr>
                    <td>Nomor Identitas</td>
                    <td>:</td>
                    <td><b>${@this.numberIdentity}</b></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>:</td>
                    <td>
                        ${@this.status}
                    </td>
                </tr>
            </table>`;

                var map = L.map('map', {
                    center: [lat, lon],
                    zoom: 13,
                    layers: [osm],
                    minZoom: 5,
                    maxZoom: 18,
                });

                var institutionMarker = L.marker([lat, lon]).addTo(map)
                    .bindPopup(popupinstitution)
                    .openPopup();

                var absenceMarker = L.marker([@this.absenceLat, @this.absenceLng]).addTo(map)
                    .bindPopup(popupAbsence)
                    .openPopup();

                if (@this.radiusLingkaran) {
                    var circle = L.circle(institutionLocation, {
                        radius: parseInt(@this.radiusLingkaran),
                        color: '#500A94',
                    }).addTo(map);
                }

                if (@this.institutionLogo) {
                    institutionMarker.setIcon(univIcon);
                }

                var polyline = L.polyline(comparationLatLang, {
                    color: 'red',
                    weight: 4,
                    opacity: 0.7,
                    smoothFactor: 1
                }).addTo(map);

                var distanceToAbsence = institutionLocation.distanceTo(absenceLocation);
                var radius = circle.getRadius();
                var distanceFromCircleEdge = Math.max(0, distanceToAbsence - radius);

                document.getElementById('distanceToAbsence').append(Math.round(distanceToAbsence) +
                    ' Meter');

                document.getElementById('distanceFromCircleEdge').append(
                    "Jarak dari tepi luar lingkaran ke lokasi absensi : " + Math.round(distanceFromCircleEdge) +
                    " Meter")

                map.fitBounds(polyline.getBounds());
            }
        });
    </script>
@endpush
