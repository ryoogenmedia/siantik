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

            .avatar {
                width: 50px;
                height: 50px;
                object-fit: cover;
            }

            .badge {
                padding: 0.5em 1em;
                font-size: 0.875rem;
                font-weight: 500;
                border-radius: 0.25rem;
                color: #fff;
            }

            .bg-success-lt {
                background-color: #28a745;
            }

            .bg-red-lt {
                background-color: #dc3545;
            }

            .bg-orange-lt {
                background-color: #fd7e14;
            }

            .bg-yellow-lt {
                background-color: #ffc107;
            }

            .bg-blue-lt {
                background-color: #007bff;
            }

            .bg-purple-lt {
                background-color: #6f42c1;
            }

            .bg-grey-lt {
                background-color: #6c757d;
            }

            .popup-table {
                width: 100%;
                border-collapse: collapse;
                margin: 10px 0;
                font-family: Arial, sans-serif;
            }

            .popup-table th,
            .popup-table td {
                padding: 5px;
                text-align: left;
            }

            .popup-table th {
                font-weight: bold;
            }

            .text-center {
                text-align: center;
            }

            .rounded-circle {
                border-radius: 50%;
            }

            .header-img {
                object-fit: cover;
                width: 50px;
                height: 50px;
            }
        </style>
    @endsection
@endonce

<div>
    <x-slot name="title">Detail Presensi</x-slot>

    <x-slot name="pagePretitle">Detail Data Presensi</x-slot>

    <x-slot name="pageTitle">Detail Presensi</x-slot>

    <x-slot name="button">
        <a href="{{ route('report.admin') }}" class="btn btn-sm tf-btn primary">Kembali</a>
    </x-slot>

    <x-alert />

    <div class="card" wire:submit.prevent="save" autocomplete="off">
        <div class="card-body">
            <div class="row">
                @if (isset($this->imageAbsence))
                    <div class="col-lg-5 col-12">
                        <img class="rounded-md" src="{{ asset($this->imageAbsence) }}"
                            alt="presensi-pengguna-{{ $this->personnelName }}">
                    </div>
                @endif

                <div class="col-lg-7 col-12">
                    <div class="mt-lg-0 mt-3">
                        <h6 class="mb-2">Nama</h6>
                        <p class="mb-2">{{ $this->personnelName }}</p>
                        <hr class="my-0 mt-3">
                    </div>

                    <div class="mt-3">
                        <h6 class="mb-2">Waktu Masuk</h6>
                        <p class="mb-2 fs-6"><b>{{ \Carbon\Carbon::parse($this->date)->format('H:i') }}</b> |
                            {{ \Carbon\Carbon::parse($this->date)->format('d/m/Y') }}
                        </p>
                        <p class="mb-2">
                            <span
                                class="badge
                                {{ $this->status == 'hadir' ? 'bg-success-lt' : '' }}
                                {{ $this->status == 'terlambat' ? 'bg-red-lt' : '' }}
                                {{ $this->status == 'izin' ? 'bg-orange-lt' : '' }}
                                {{ $this->status == 'cuti' ? 'bg-yellow-lt' : '' }}
                                {{ $this->status == 'tugas' ? 'bg-blue-lt' : '' }}
                                {{ $this->status == 'pendidikan' ? 'bg-purple-lt' : '' }}
                                {{ $this->status == 'sakit' ? 'bg-grey-lt' : '' }}">
                                {{ $this->status }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="card-body">
            <h6>Detail Lokasi Presensi</h6>
        </div>

        <hr>

        <div class="card-body">
            <div class="row">
                <div class="col-12" id="map" style="height: 300px;"></div>
            </div>
        </div>

        <hr>

        <div class="card-body">
            <h6>Hasil Komparasi</h6>
        </div>

        <hr>

        <div class="card-body">
            <div class="row">
                <div class="col-lg-3">
                    <div class="mb-4">
                        <p class="mb-1 text-black">Radius Lembaga</p>
                        <p class="mb-2" style="font-size: 13px">Radius Lingkaran :
                            <b>{{ $this->radiusLingkaran ?? '0' }}</b>
                        </p>
                        <div style="width: 100px; height: 10px; background-color: #500A94; font-size: 13px"></div>
                    </div>

                    <div>
                        <p class="mb-1 text-black">Jarak Dari Titik Lembaga</p>
                        <p class="mb-2" style="font-size: 13px">Panjang Garis : <b id="distanceToAbsence"></b></p>
                        <div style="width: 100px; height: 10px; background-color: #E54043"></div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <h6 class="mb-4 text-black">Kesimpulan</h6>
                    <p style="font-size: 13px" id="distanceFromCircleEdge"></p>
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
                return new Promise((resolve) => {
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
                initMap({{ $this->institutionLat ?? -5.147665 }},
                    {{ $this->institutionLng ?? 119.432732 }});
            });

            function initMap(lat, lon) {
                var osm = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                });

                var institutionLocation = L.latLng(lat, lon);

                var institutionLogo = L.icon({
                    iconUrl: @this.institutionLogo,
                    iconSize: [38, 38],
                });

                // var absenceIcon = L.icon({
                //     iconUrl: @this.markerIcon,
                //     iconSize: [38, 38],
                // });

                var popupInstitution = `
                    <table class="popup-table" cellpadding="5">
                        <tr>
                            <td class="text-center" colspan="3">
                                <img class="rounded-circle" style="object-fit: cover; width: 50px; height: 50px;" src='${@this.institutionLogo}' alt='gambar-lembaga'/>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center"><b>${@this.institutionName}</b></td>
                        </tr>
                        <tr>
                            <td class="text-center">Polres Tabes Makassar</td>
                        </tr>
                        <tr>
                            <td class="text-center">${@this.institutionAddress}</td>
                        </tr>
                    </table>`;

                var popupAbsence = `
                    <table class="popup-table" cellpadding="5">
                        <tr>
                            <td class="text-center" colspan="3">
                                <img class="rounded-circle" style="object-fit: cover; width: 50px; height: 50px;" src='${@this.absenceImg}' alt='gambar-lembaga'/>
                            </td>
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
                            <td>Nomor Ponsel</td>
                            <td>:</td>
                            <td><b>${@this.phoneNumber}</b></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><b>${@this.emailPersonnel}</b></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td><b>${@this.status}</b></td>
                        </tr>
                    </table>`;

                var map = L.map('map', {
                    center: [lat, lon],
                    zoom: 13,
                    layers: [osm],
                    minZoom: 5,
                    maxZoom: 18,
                });

                var institutionMarker = L.marker([lat, lon], {
                        icon: institutionLogo
                    }).addTo(map)
                    .bindPopup(popupInstitution)
                    .openPopup();

                var absenceMarker = L.marker([@this.absenceLat, @this.absenceLng]).addTo(map)
                    .bindPopup(popupAbsence)
                    .openPopup();

                var comparationLatLang = [
                    [lat, lon],
                    [@this.absenceLat, @this.absenceLng]
                ];

                var polyline = L.polyline(comparationLatLang, {
                    color: 'red',
                    weight: 4,
                    opacity: 0.7,
                    smoothFactor: 1
                }).addTo(map);

                if (@this.radiusLingkaran) {
                    L.circle(institutionLocation, {
                        radius: parseInt(@this.radiusLingkaran),
                        color: '#500A94',
                    }).addTo(map);
                }

                document.getElementById('distanceToAbsence').innerText = Math.floor(map.distance(
                    institutionLocation,
                    L.latLng(@this.absenceLat, @this.absenceLng))) + ' Meter';

                document.getElementById('distanceFromCircleEdge').innerText = 'Jarak dari tepi luar lingkaran ke lokasi presensi : ' + Math.floor(
                    Math.abs(map.distance(institutionLocation, L.latLng(@this.absenceLat, @this.absenceLng)) -
                        @this.radiusLingkaran)) + ' Meter';
            }
        });
    </script>
@endpush

