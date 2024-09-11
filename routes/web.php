<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasienController;
use App\Http\Middleware\OnlyGuestMiddleware;
use App\Http\Middleware\OnlyMemberMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->middleware(OnlyGuestMiddleware::class);
    Route::post('/login', 'login')->middleware(OnlyGuestMiddleware::class);
    Route::post('/logout', 'logout')->middleware(OnlyMemberMiddleware::class);
});
Route::controller(PasienController::class)->middleware(OnlyMemberMiddleware::class)->group(function () {
    Route::get('/', 'index')->name('index');

    Route::get('/pasien/{noRawat}', 'detail')->name('detail');
    Route::get('/pasien/{noRawat}/soapie', 'soapie')->name('soapie');
    Route::get('/pasien/{noRawat}/diagnosa', 'diagnosa')->name('diagnosa');
    Route::get('/pasien/{noRawat}/laboratorium', 'laboratorium')->name('laboratorium');
    Route::get('/pasien/{noRawat}/radiologi', 'radiologi')->name('radiologi');
    Route::get('/pasien/{noRawat}/eresep', 'eresep')->name('eresep');

    Route::get('/search-items-icd10', 'SearchIcd10')->name('SearchIcd10');
    Route::get('/search-items-icd9', 'SearchIcd9')->name('SearchIcd9');
});
