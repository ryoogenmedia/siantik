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
    <x-slot name="title">Lokasi</x-slot>
    <x-slot name="pageTitle">Atur Data Lokasi</x-slot>
    <x-slot name="pagePretitle">Mengatur data lokasi.</x-slot>

    <x-alert />

    <form wire:submit.prevent='save' autocomplete="off">
        <x-backend.form.input wire:model='logo' label="Logo" name="logo" type="file"
            optional="Abaikan jika tidak ingin mengubah" />

        <x-backend.form.input wire:model='namaInstitusi' label="Nama Institusi" name="namaInstitusi" type="text"
            placeholder="masukkan nama institusi" autofocus required />

        <x-backend.form.input wire:model='alamat' label="Alamat" name="alamat" type="text"
            placeholder="Nama Kota, Nama Jl, Kode Pos" required />

        <x-backend.form.input wire:model='absensiPagi' label="Waktu Absensi Pagi" name="absensiPagi" type="time"
            required />

        <x-backend.form.input wire:model='absensiSiang' label="Waktu Absensi Siang" name="absensiSiang" type="time"
            required />

        <x-backend.form.input wire:model='radiusLingkaran' label="Radius Lingkaran" name="radiusLingkaran"
            min="0" type="number" required />

        <div wire:ignore class="row px-3 my-5">
            <div class="col-4 mb-2 px-0 mx-0">
                <button wire:click='resetLocation' class="btn btn-sm tf-btn primary" type="button">Reset Lokasi
                    Map</button>
            </div>

            <div class="col-12 px-3" id="map"></div>
        </div>

        <x-backend.form.input wire:model='longitude' label="Longitude" name="longitude" type="text" disabled
            required />

        <x-backend.form.input wire:model='latitude' label="Latitude" name="latitude" type="text" disabled required />

        <x-backend.button.save name="Simpan Perubahan" target="save" />
    </form>
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
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(
                            (position) => {
                                let latitude = @this.latitude ?? position.coords.latitude;
                                let longitude = @this.longitude ?? position.coords.longitude;

                                Livewire.dispatch('location', {
                                    latitude: latitude,
                                    longitude: longitude
                                });

                                resolve({
                                    latitude,
                                    longitude
                                });
                            },
                            (error) => {
                                console.error(error);
                                reject(error);
                            }
                        );
                    } else {
                        reject(new Error("Geolocation tidak didukung atau situs tidak aman."));
                    }
                });
            }

            getLatLon().then((coords) => {
                initMap(coords.latitude, coords.longitude);
            }).catch((error) => {
                console.error("Gagal mendapatkan lokasi: ", error);
                initMap({{ $this->latitude ?? -5.155978984099238 }},
                    {{ $this->longitude ?? 119.40353393554689 }});
            });

            function initMap(lat, lon) {
                var osm = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                });

                var map = L.map('map', {
                    center: [lat, lon],
                    zoom: 13,
                    layers: [osm],
                    minZoom: 5,
                    maxZoom: 18,
                });

                if (@this.longitude && @this.latitude) {
                    map.setZoom(19);
                }

                if (lat && lon) {
                    var marker = L.marker([lat, lon], {
                        draggable: true,
                    }).addTo(map);
                }

                if (@this.showLogo) {
                    var customIcon = L.icon({
                        iconUrl: @this.showLogo,
                        iconSize: [38, 38],
                        popupAnchor: [-3, -38],
                    });

                    marker.setIcon(customIcon);
                }

                if (@this.radiusLingkaran) {
                    var circle = L.circle([lat, lon], {
                        radius: parseInt(@this.radiusLingkaran),
                        color: '#500A94',
                    }).addTo(map);
                }

                map.on('click', function(e) {
                    @this.longitude = e.latlng.lng;
                    @this.latitude = e.latlng.lat;
                    if (!marker) {
                        marker = L.marker(e.latlng).addTo(map);
                    } else {
                        marker.setLatLng(e.latlng);
                        circle.setLatLng(e.latlng);
                    }
                });

                marker.on('dragend', function(e) {
                    let coordinate = e.target._latlng;
                    @this.longitude = coordinate.lng;
                    @this.latitude = coordinate.lat;
                    marker.setLatLng(coordinate);
                    circle.setLatLng(coordinate);
                });

                var searchControl = new L.esri.Controls.Geosearch().addTo(map);
                var results = new L.LayerGroup().addTo(map);

                searchControl.on('results', function(data) {
                    results.clearLayers();

                    @this.latitude = data.results[0].latlng['lat'];
                    @this.longitude = data.results[0].latlng['lng'];

                    marker.setLatLng(data.results[0].latlng, {
                        draggable: true
                    });

                    circle.setLatLng(data.results[0].latlng, {
                        draggable: true
                    });
                });
            }
        });
    </script>
@endpush
