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
    <x-slot name="title">Beranda</x-slot>
    <x-slot name="pageTitle">Dashboard</x-slot>
    <x-slot name="pagePretitle">Ringkasan aplikasi anda berada disini.</x-slot>

    @if (auth()->user()->roles == 'personnel' || auth()->user()->roles == 'leader')
        <div class="row mb-2">
            <div class="col-12">
                <div class="card border border-success">
                    <div class="card-header text-success">
                        <h6>Selamat datang kembali, {{ auth()->user()->name }} 👋</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-2">
                    <div class="card-header text-primary">Kehadiran</div>
                    <div class="card-body">
                        <h3>{{ $this->jmlKehadiran ?? 0 }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card mb-2">
                    <div class="card-header text-primary">Pengajuan Perizinan</div>
                    <div class="card-body">
                        <h3>{{ $this->jmlPerizinan ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            @if (auth()->user()->roles == 'personnel')
                <h5>Lokasi absensi anda hari ini.</h5>
            @else
                <h5>Daftar presensi personnel hari ini.</h5>
            @endif
            <div class="col-12">
                <div wire:ignore.self class="row p-2">
                    <div class="col-12" id="map"></div>
                </div>
            </div>
        </div>

        <div id="attendance-data" data-attendance="{{ json_encode($this->attendance) }}"></div>
    @endif

    @if (auth()->user()->roles == 'superadmin')
        <div class="row">
            <div class="col-6">
                <div class="card mb-2">
                    <div class="card-header text-primary">Jumlah Pengguna</div>
                    <div class="card-body">
                        <h3>{{ $this->jmlPengguna ?? 0 }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card mb-2">
                    <div class="card-header text-primary">Jumlah Personnel</div>
                    <div class="card-body">
                        <h3>{{ $this->jmlPersonnel ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <div class="card mb-2">
                    <div class="card-header text-primary">Radius Lingkaran Absensi</div>
                    <div class="card-body">
                        <h3>{{ $this->radiusLingkaran ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->roles == 'admin')
        <div class="line4-bt pb-12">
            <div class="tf-container">
                <div class="d-flex gap-12 justify-content-between align-items-center">
                    <div class="search-box">
                        <x-backend.form.select wire:model.lazy='bulan' name="bulan" class-form-group>
                            <option value="">- semua bulan -</option>
                            @foreach (config('const.month') as $bulan)
                                <option value="{{ $loop->iteration }}">{{ $bulan }}</option>
                            @endforeach
                        </x-backend.form.select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="card mb-2">
                    <div class="card-header text-primary">Hadir</div>
                    <div class="card-body">
                        <h3>{{ $this->jmlHadir }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card mb-2">
                    <div class="card-header text-primary">Izin</div>
                    <div class="card-body">
                        <h3>{{ $this->jmlIzin }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card mb-2">
                    <div class="card-header text-primary">Cuti</div>
                    <div class="card-body">
                        <h3>{{ $this->jmlCuti }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card mb-2">
                    <div class="card-header text-primary">Tugas</div>
                    <div class="card-body">
                        <h3>{{ $this->jmlTugas }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card mb-2">
                    <div class="card-header text-primary">Pendidikan</div>
                    <div class="card-body">
                        <h3>{{ $this->jmlPendidikan }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card mb-2">
                    <div class="card-header text-primary">Terlambat</div>
                    <div class="card-body">
                        <h3>{{ $this->jmlTerlambat }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <h5>Daftar presensi hari ini.</h5>
            <div class="col-12">
                <div wire:ignore.self class="row p-2">
                    <div class="col-12" id="map"></div>
                </div>
            </div>
        </div>
        <div id="attendance-data" data-attendance="{{ json_encode($this->attendance) }}"></div>
    @endif
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

                var absenceIcon = L.icon({
                    iconUrl: @this.markerIcon,
                    iconSize: [38, 38],
                });

                var popupinstitution = `<table class="popup-table" cellpadding="5">
                    <tr>
                        <td class="text-center" colspan="3"><img class="rounded-circle" style="object-fit: cover; width: 50px" src='${@this.institutionLogo}' alt='gambar-lembaga'/></td>
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

                var map = L.map('map', {
                    center: [lat, lon],
                    zoom: 5,
                    layers: [osm],
                    minZoom: 5,
                    maxZoom: 18,
                });

                var institutionMarker = L.marker([lat, lon], {
                        icon: institutionLogo
                    }).addTo(map)
                    .bindPopup(popupinstitution)
                    .openPopup();

                const attendanceData = JSON.parse(document.getElementById('attendance-data').getAttribute(
                    'data-attendance'));

                var bounds = L.latLngBounds([lat, lon]);

                var routes = {
                    adminDetailAttendance: "{{ route('report.admin-detail', ['id' => 'REPLACE_ID']) }}",
                    leaderDetailAttendance: "{{ route('daily-report.leader-detail', ['id' => 'REPLACE_ID']) }}",
                };

                attendanceData.forEach(function(value) {
                    map.setZoom(18);
                    var userRole = "{{ auth()->user()->roles }}";
                    var route;
                    var attendanceId = value.id;
                    var attendanceLat = value.latitude;
                    var attendanceLng = value.longitude;
                    var absenceLocation = L.latLng(attendanceLat, attendanceLng);
                    var comparationLatLang = [institutionLocation, absenceLocation];

                    if (userRole == "leader") {
                        route = routes.leaderDetailAttendance.replace('REPLACE_ID', value.id);
                    } else {
                        route = routes.adminDetailAttendance.replace('REPLACE_ID', value.id);
                    }

                    bounds.extend(absenceLocation);

                    // Avatar display logic
                    var avatar = value.akun.avatar ?
                        `<td class="text-center" colspan="3"><img class="avatar rounded-circle" src='{{ asset('storage/' . '${value.akun.avatar}') }}' alt='gambar-user'/></td>` :
                        `<td class="text-center" colspan="3"><img class="avatar rounded-circle" src='https://gravatar.com/avatar?s=1024' alt='gambar-user'/></td>`;

                    // Bind popup based on user role
                    L.marker([attendanceLat, attendanceLng], {
                            icon: absenceIcon,
                        }).addTo(map)
                        .bindPopup(`
                        <table class="popup-table" cellpadding="5">
                             <tr>
                                ${avatar}
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td><b>${value.akun.name}</b></td>
                            </tr>
                            <tr>
                                <td>Nomor Identitas</td>
                                <td>:</td>
                                <td><b>${value.akun.personnel.number_identity}</b></td>
                            </tr>
                            <tr>
                                <td>Nomor Ponsel</td>
                                <td>:</td>
                                <td><b>${value.akun.phone_number}</b></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td><b>${value.akun.email}</b></td>
                            </tr>
                            <tr>
                                <td>Keterangan</td>
                                <td>:</td>
                                <td><b>${value.status_attendance}</b></td>
                            </tr>
                            <tr>
                                <td class='text-center' colspan='3'>
                                    ${userRole === "personnel" ?
                                        ''
                                     : `<a href="${route}" class="btn bg-success-lt mt-3">Lihat Detail</a>`
                                    }
                                </td>
                            </tr>
                        </table>`);
                });

                if (@this.radiusLingkaran) {
                    var circle = L.circle(institutionLocation, {
                        radius: parseInt(@this.radiusLingkaran),
                        color: '#500A94',
                    }).addTo(map);
                }

                map.fitBounds(bounds);
                map.setMaxBounds(bounds);
            }
        });
    </script>
@endpush
