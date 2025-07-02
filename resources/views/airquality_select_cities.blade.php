@extends('layouts.app')

@section('title', 'Pilih Kota untuk Peta Kualitas Udara')

@push('head')
    <!-- CSS Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <h1 class="text-xl font-bold mb-4">Pilih Kabupaten/Kota (maksimal 20)</h1>

    <form method="POST" action="{{ route('airquality.map.show') }}">
        @csrf
        <select
            name="regency_ids[]"
            multiple="multiple"
            id="regency_ids"
            required
            style="width: 100%; max-width: 600px;"
            data-placeholder="Pilih kota-kota..."
            size="10"
        >
            @foreach($regencies as $regency)
                <option value="{{ $regency->id }}">{{ $regency->name }}</option>
            @endforeach
        </select>
        <br><br>
        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
            Tampilkan Peta
        </button>
    </form>
@endsection

@push('scripts')
    <!-- Pastikan jQuery sudah dimuat di layout utama, jika belum tambahkan di sini -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- JS Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#regency_ids').select2({
                placeholder: $('#regency_ids').data('placeholder'),
                maximumSelectionLength: 20,
                allowClear: true,
                closeOnSelect: false,
                width: 'resolve'
            });

            // Fokus otomatis ke search box saat dropdown dibuka
            $('#regency_ids').on('select2:open', () => {
                document.querySelector('.select2-search__field').focus();
            });
        });
    </script>
@endpush
