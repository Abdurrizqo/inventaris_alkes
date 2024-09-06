<?php

use App\Http\Controllers\AlkesController;
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

Route::get('/', [AlkesController::class, 'homeControlle']);
Route::get('/scan-qr-alkes', [AlkesController::class, 'scanAlkesView']);
Route::post('/pinjam-barang', [AlkesController::class, 'pinjamBarang']);
Route::get('/detail-peminjaman/{id}', [AlkesController::class, 'barangKembaliView']);

Route::get('/barang-kembali/{id}', [AlkesController::class, 'updateBarangKembali']);
Route::get('/barang-hilang/{id}', [AlkesController::class, 'updateBarangHilang']);


Route::get('/data-alkes/{id}', [AlkesController::class, 'guestViewAlkes']);
