@extends('layouts.app')

@section('title', 'Air Quality & Gempa Indonesia')
@section('header', 'Selamat Datang di Portal Data Lingkungan Indonesia')
@section('subtitle', 'Akses data kualitas udara dan gempa bumi terkini di Indonesia. Pilih visualisasi yang ingin Anda
    lihat:')

@section('content')
    <div class="flex flex-col md:flex-row gap-8 justify-center items-center mt-8">
        <a href="{{ url('airquality') }}"
            class="flex-1 max-w-xs bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-lg p-8 flex flex-col items-center transition">
            <span class="text-4xl mb-2">🌫️</span>
            <span class="font-bold text-xl mb-1">Tabel Kualitas Udara</span>
            <span class="text-sm text-blue-100">Lihat data kualitas udara kota-kota di Indonesia dalam bentuk tabel.</span>
        </a>
        <a href="{{ url('airquality-map') }}"
            class="flex-1 max-w-xs bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-lg p-8 flex flex-col items-center transition">
            <span class="text-4xl mb-2">🗺️</span>
            <span class="font-bold text-xl mb-1">Peta Kualitas Udara</span>
            <span class="text-sm text-green-100">Visualisasi kualitas udara kota di Indonesia secara Real-Time</span>
        </a>
        <a href="{{ url('gempa') }}"
            class="flex-1 max-w-xs bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg shadow-lg p-8 flex flex-col items-center transition">
            <span class="text-4xl mb-2">🌏</span>
            <span class="font-bold text-xl mb-1">Peta Gempa Terkini</span>
            <span class="text-sm text-yellow-100">Lihat peta interaktif gempa bumi terbaru dari BMKG.</span>
        </a>
    </div>
@endsection
