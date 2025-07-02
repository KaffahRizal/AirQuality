<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AirQualityController;

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/', function () {
    return view('home');
});

Route::get('/airquality', [AirQualityController::class, 'index']);

Route::get('/airquality-map', [AirQualityController::class, 'map']);

Route::get('/gempa', function () {
    return view('gempa');
});


Route::get('/airquality/select-cities', [AirQualityController::class, 'selectCities'])->name('airquality.select.cities');
Route::post('/airquality/map', [AirQualityController::class, 'showMap'])->name('airquality.map.show');

