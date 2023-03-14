<?php

use App\Http\Controllers\CamConfigController;
use App\Http\Controllers\DetectorController;
use App\Http\Controllers\MeteranController;
use App\Http\Controllers\SummaryDataController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('detector', DetectorController::class);
Route::resource('summary-data', SummaryDataController::class);
Route::resource('meteran', MeteranController::class);

Route::get('/detect', function () {
    return view('detect');
});

Route::get('/trial', function () {
    return view('trial');
});

Route::post('/save/config/{type}', [CamConfigController::class, 'saveConfig']);
Route::get('/get/config/{type}', [CamConfigController::class, 'GetConfig']);
Route::get('/admin/meteran/image{id}', [MeteranController::class, 'image'])->name('meteran.image');
