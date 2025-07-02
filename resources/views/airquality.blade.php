@extends('layouts.app')

@section('title', 'Data Air Quality Kota di Indonesia')
@section('header', 'Data Air Quality Kota di Indonesia')
@section('subtitle',
    'Pantau kualitas udara di berbagai kota Indonesia secara real-time dan interaktif. Data diambil
    dari WeatherAPI dan divisualisasikan dengan tabel modern.')

@section('header-actions')
    <div class="flex flex-col md:flex-row gap-4 justify-center items-center mt-4">
        {{-- Tidak tampilkan tombol tabel kualitas udara di halaman ini --}}
        <a href="{{ url('airquality-map') }}"
            class="flex-1 max-w-xs bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-lg p-4 flex flex-col items-center transition">
            <span class="text-2xl mb-1">🗺️</span>
            <span class="font-bold">Peta Kualitas Udara</span>
            <span class="text-xs text-green-100">Visualisasi kualitas udara kota di Indonesia Secara Real-Time pada peta interaktif.</span>
        </a>
        <a href="{{ url('gempa') }}"
            class="flex-1 max-w-xs bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg shadow-lg p-4 flex flex-col items-center transition">
            <span class="text-2xl mb-1">🌏</span>
            <span class="font-bold">Peta Gempa Terkini</span>
            <span class="text-xs text-yellow-100">Lihat peta interaktif gempa bumi terbaru dari BMKG.</span>
        </a>
    </div>
@endsection

@section('content')
    <table class="min-w-full border text-center bg-white rounded-lg overflow-hidden">
        <thead>
            <tr>
                <th class="px-2 py-1 bg-gray-100">Kota</th>
                <th class="px-2 py-1 bg-gray-100">CO (µg/m³)</th>
                <th class="px-2 py-1 bg-gray-100">O3 (µg/m³)</th>
                <th class="px-2 py-1 bg-gray-100">NO2 (µg/m³)</th>
                <th class="px-2 py-1 bg-gray-100">SO2 (µg/m³)</th>
                <th class="px-2 py-1 bg-gray-100">PM2.5 (µg/m³)</th>
                <th class="px-2 py-1 bg-gray-100">PM10 (µg/m³)</th>
                <th class="px-2 py-1 bg-gray-100">US-EPA Index</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $result)
                <tr class="hover:bg-blue-50">
                    <td class="px-2 py-1">{{ $result['city'] }}</td>
                    @if ($result['aq'])
                        <td class="px-2 py-1">{{ $result['aq']['co'] ?? '-' }}</td>
                        <td class="px-2 py-1">{{ $result['aq']['o3'] ?? '-' }}</td>
                        <td class="px-2 py-1">{{ $result['aq']['no2'] ?? '-' }}</td>
                        <td class="px-2 py-1">{{ $result['aq']['so2'] ?? '-' }}</td>
                        <td class="px-2 py-1">{{ $result['aq']['pm2_5'] ?? '-' }}</td>
                        <td class="px-2 py-1">{{ $result['aq']['pm10'] ?? '-' }}</td>
                        <td class="px-2 py-1">{{ $result['aq']['us-epa-index'] ?? '-' }}</td>
                    @else
                        <td class="px-2 py-1" colspan="7">Data tidak tersedia</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
