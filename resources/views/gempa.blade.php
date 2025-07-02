@extends('layouts.app')

@section('title', 'Peta Gempa Terkini Indonesia')
@section('header', 'Peta Gempa Terkini Indonesia')
@section('subtitle', 'Data real-time gempa dari BMKG, visualisasi interaktif dengan Leaflet & Tailwind CSS')

@section('header-actions')
    <div class="flex flex-col md:flex-row gap-4 justify-center items-center mt-4">
        <a href="{{ url('airquality') }}"
            class="flex-1 max-w-xs bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-lg p-4 flex flex-col items-center transition">
            <span class="text-2xl mb-1">🌫️</span>
            <span class="font-bold">Tabel Kualitas Udara</span>
            <span class="text-xs text-blue-100">Lihat data kualitas udara kota-kota di Indonesia dalam bentuk tabel.</span>
        </a>
        <a href="{{ url('airquality-map') }}"
            class="flex-1 max-w-xs bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-lg p-4 flex flex-col items-center transition">
            <span class="text-2xl mb-1">🗺️</span>
            <span class="font-bold">Peta Kualitas Udara</span>
            <span class="text-xs text-green-100">Visualisasi kualitas udara kota di Indonesia pada peta interaktif.</span>
        </a>
        {{-- Tidak tampilkan tombol peta gempa di halaman ini --}}
    </div>
@endsection

@section('content')
    <div id="map" class="rounded-lg overflow-hidden" style="height:600px;"></div>
@endsection

@push('head')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        #map {
            height: 600px;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        var map = L.map('map').setView([-0.3155398750904368, 117.1371634207888], 5);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 5,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        let datas = {!! file_get_contents('https://data.bmkg.go.id/DataMKG/TEWS/gempaterkini.json') !!}
        let gempas = datas.Infogempa.gempa;

        gempas.forEach(gempa => {
            let kordinat = gempa.Coordinates.split(",");
            let _lat = kordinat[0];
            let _log = kordinat[1];
            let marker = L.marker([_lat, _log]).addTo(map);

            marker.bindPopup(
                `<b>Wilayah:</b> ${gempa.Wilayah}<br>` +
                `<b>Waktu:</b> ${gempa.Jam} - ${gempa.Tanggal}<br>` +
                `<b>Kekuatan:</b> ${gempa.Magnitude}<br>` +
                `<b>Kedalaman:</b> ${gempa.Kedalaman}<br>` +
                `<b>Potensi:</b> ${gempa.Potensi}<br>` +
                `<b>Koordinat:</b> ${gempa.Coordinates}<br>` +
                `<b>Bujur:</b> ${gempa.Bujur}<br>` +
                `<b>Datetime:</b> ${gempa.DateTime}`
            );
        });
    </script>
@endpush
