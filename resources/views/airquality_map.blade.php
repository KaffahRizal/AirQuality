@extends('layouts.app')

@section('title', 'Peta Air Quality Indonesia dengan Marker Berwarna')
@section('header', 'Peta Kualitas Udara Kota-kota di Indonesia')
@section('subtitle', 'Pantau kualitas udara di berbagai kota secara visual, Real-Time dan interaktif')

@section('header-actions')
    <div class="flex flex-col md:flex-row gap-4 justify-center items-stretch mt-4">
        <a href="{{ url('airquality/select-cities') }}"
            class="h-full flex-1 max-w-xs bg-green-500 hover:bg-green-700 text-white rounded-lg shadow-lg p-4 flex flex-col items-center transition min-h-[130px]">
            <span class="text-2xl mb-1">🗺️</span>
            <span class="font-bold">Pilih Kota untuk Peta</span>
            <span class="text-xs text-green-100 text-center">Pilih kota yang ingin ditampilkan di peta kualitas udara.</span>
        </a>
        <a href="{{ url('gempa') }}"
            class="h-full flex-1 max-w-xs bg-yellow-500 hover:bg-yellow-700 text-white rounded-lg shadow-lg p-4 flex flex-col items-center transition min-h-[130px]">
            <span class="text-2xl mb-1">🌏</span>
            <span class="font-bold">Peta Gempa Terkini</span>
            <span class="text-xs text-yellow-100 text-center">Lihat peta interaktif gempa bumi terbaru dari BMKG.</span>
        </a>
    </div>
@endsection

@section('content')
    <div class="flex flex-col lg:flex-row gap-4 mt-4">
        <!-- Map Box -->
        <div class="flex-1">
            <div class="relative">
                <div id="map" class="rounded-lg overflow-hidden w-full h-[600px]"></div>
            </div>
        </div>

        <!-- Legend Box -->
        <div id="legend"
            class="w-full lg:w-64 bg-white/90 border border-gray-300 rounded-lg shadow-lg p-4 text-sm">
            <div class="font-bold mb-2">Legenda Kategori Kualitas Udara</div>
            <ul class="space-y-2">
                <li class="flex items-center gap-2">
                    <span class="w-4 h-4 rounded-full bg-green-500 inline-block"></span>
                    <span>Baik</span>
                </li>
                <li class="flex items-center gap-2">
                    <span class="w-4 h-4 rounded-full bg-yellow-400 inline-block"></span>
                    <span>Sedang</span>
                </li>
                <li class="flex items-center gap-2">
                    <span class="w-4 h-4 rounded-full bg-orange-400 inline-block"></span>
                    <span>Tidak Sehat untuk kelompok sensitif</span>
                </li>
                <li class="flex items-center gap-2">
                    <span class="w-4 h-4 rounded-full bg-red-500 inline-block"></span>
                    <span>Tidak Sehat</span>
                </li>
                <li class="flex items-center gap-2">
                    <span class="w-4 h-4 rounded-full bg-blue-600 inline-block"></span>
                    <span>Sangat Tidak Sehat</span>
                </li>
                <li class="flex items-center gap-2">
                    <span class="w-4 h-4 rounded-full bg-black inline-block"></span>
                    <span>Berbahaya</span>
                </li>
            </ul>
        </div>
    </div>
@endsection

@push('head')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        #map {
            height: 500px;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        let airQualityData = @json($airQualityData);
        let latSum = 0,
            lonSum = 0,
            count = 0;
        airQualityData.forEach(loc => {
            if (loc.lat && loc.lon) {
                latSum += parseFloat(loc.lat);
                lonSum += parseFloat(loc.lon);
                count++;
            }
        });
        let centerLat = count ? latSum / count : -2.548926;
        let centerLon = count ? lonSum / count : 118.0148634;

        var map = L.map('map').setView([centerLat, centerLon], 5);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        const epaCategories = {
            1: 'Baik',
            2: 'Sedang',
            3: 'Tidak Sehat untuk kelompok sensitif',
            4: 'Tidak Sehat',
            5: 'Sangat Tidak Sehat',
            6: 'Berbahaya'
        };

        function getMarkerIcon(epaIndex) {
            const iconBaseUrl = 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-';
            let color = 'grey';
            switch (epaIndex) {
                case 1:
                    color = 'green';
                    break;
                case 2:
                    color = 'yellow';
                    break;
                case 3:
                    color = 'orange';
                    break;
                case 4:
                    color = 'red';
                    break;
                case 5:
                    color = 'blue';
                    break;
                case 6:
                    color = 'black';
                    break;
                default:
                    color = 'grey';
            }
            return new L.Icon({
                iconUrl: iconBaseUrl + color + '.png',
                shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
        }

        airQualityData.forEach(location => {
            if (location.lat && location.lon && location.aq) {
                let epaIndex = location.aq['us-epa-index'];
                let epaCategory = epaCategories[epaIndex] || 'Unknown';
                let markerIcon = getMarkerIcon(epaIndex);
                let marker = L.marker([location.lat, location.lon], {
                    icon: markerIcon
                }).addTo(map);

                let popupContent = `<b>${location.city}</b><br>
                    Timezone: ${location.tz_id ?? '-'}<br>
                    Local Time: ${location.localtime ?? '-'}<br>
                    CO: ${location.aq.co.toFixed(2)} µg/m³<br>
                    O3: ${location.aq.o3.toFixed(2)} µg/m³<br>
                    NO2: ${location.aq.no2.toFixed(2)} µg/m³<br>
                    SO2: ${location.aq.so2.toFixed(2)} µg/m³<br>
                    PM2.5: ${location.aq.pm2_5.toFixed(2)} µg/m³<br>
                    PM10: ${location.aq.pm10.toFixed(2)} µg/m³<br>
                    US-EPA Index: ${epaIndex} (${epaCategory})<br>`;
                marker.bindPopup(popupContent);
            }
        });

        // Tambahkan North Arrow sebagai Leaflet Control (inline SVG)
        var north = L.control({ position: "topright" });
        north.onAdd = function (map) {
            var div = L.DomUtil.create("div");
            div.innerHTML = `
                <div class="w-20 h-20 opacity-80 hover:opacity-100 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" class="w-full h-full">
                        <polygon points="100,0 120,50 100,40 80,50" fill="red"/>
                        <polygon points="100,200 80,150 100,160 120,150" fill="black"/>
                        <text x="100" y="100" text-anchor="middle" font-size="30" fill="black" dy=".3em">N</text>
                    </svg>
                </div>
            `;
            return div;
        };
        north.addTo(map);
    </script>
@endpush
