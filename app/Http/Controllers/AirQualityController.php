<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Regency;

class AirQualityController extends Controller
{
    // Tampilkan form multi-select untuk pilih kota
    public function selectCities()
    {
        $regencies = Regency::whereNotNull('latitude')
                            ->whereNotNull('longitude')
                            ->orderBy('name')
                            ->get();

        return view('airquality_select_cities', compact('regencies'));
    }

    // Terima input array ID kota, ambil data API, tampilkan peta
    public function showMap(Request $request)
    {
        $request->validate([
            'regency_ids' => 'required|array|max:20',
            'regency_ids.*' => 'exists:regencies,id',
        ]);

        $apiKey = config('services.air_quality.key');

        $cities = Regency::whereIn('id', $request->regency_ids)
                         ->whereNotNull('latitude')
                         ->whereNotNull('longitude')
                         ->get();

        $airQualityData = [];

        foreach ($cities as $city) {
            try {
                $response = Http::timeout(10)->get('https://api.weatherapi.com/v1/current.json', [
                    'key' => $apiKey,
                    'q' => "{$city->latitude},{$city->longitude}",
                    'aqi' => 'yes'
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    $aq = $data['current']['air_quality'] ?? null;
                    $tz_id = $data['location']['tz_id'] ?? null;
                    $localtime = $data['location']['localtime'] ?? null;

                    $airQualityData[] = [
                        'city' => $city->name,
                        'lat' => $city->latitude,
                        'lon' => $city->longitude,
                        'aq' => $aq,
                        'tz_id' => $tz_id,
                        'localtime' => $localtime,
                    ];
                }
            } catch (\Exception $e) {
                // skip jika error
                continue;
            }
        }

        return view('airquality_map', compact('airQualityData'));
    }

    // Fungsi map lama (bisa dihapus jika sudah pakai selectCities + showMap)
    public function map()
    {
        $apiKey = config('services.air_quality.key');

        $cities = Regency::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->limit(20)
            ->get();

        $airQualityData = [];

        foreach ($cities as $city) {
            try {
                $response = Http::timeout(10)->get('https://api.weatherapi.com/v1/current.json', [
                    'key' => $apiKey,
                    'q' => "{$city->latitude},{$city->longitude}",
                    'aqi' => 'yes'
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    $aq = $data['current']['air_quality'] ?? null;
                    $tz_id = $data['location']['tz_id'] ?? null;
                    $localtime = $data['location']['localtime'] ?? null;

                    $airQualityData[] = [
                        'city' => $city->name,
                        'lat' => $city->latitude,
                        'lon' => $city->longitude,
                        'aq' => $aq,
                        'tz_id' => $tz_id,
                        'localtime' => $localtime,
                    ];
                }
            } catch (\Exception $e) {
                continue;
            }
        }

        return view('airquality_map', ['airQualityData' => $airQualityData]);
    }
}
