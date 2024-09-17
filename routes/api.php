<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\RumahController;
use App\Http\Controllers\PenghuniRumahController;
use App\Http\Controllers\PembayaranIuranController;

use App\Http\Controllers\PengeluaranController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('wargas', WargaController::class);
Route::apiResource('rumahs', RumahController::class);
Route::apiResource('penghuni_rumahs', PenghuniRumahController::class);
Route::apiResource('pembayaran_iurans', PembayaranIuranController::class);
Route::apiResource('pengeluarans', PengeluaranController::class);

Route::post('warga-penghuni',[PenghuniRumahController::class, 'createWargaAndPenghuniRumah']);

Route::put('updateWarga/{id}', [WargaController::class, 'update']);
Route::get('getPembayaranIuranByRumahId/{id}', [PembayaranIuranController::class, 'getPembayaranIuranByRumahId']);
Route::get('getWargaByRumahIdinPenghunirumah/{id}', [PenghuniRumahController::class, 'getWargaByRumahIdinPenghunirumah']);
Route::get('getIuranPerBulanDalamTahun/{tahun}', [PembayaranIuranController::class, 'getIuranPerBulanDalamTahun']);
Route::get('getPengeluaraByDateIn1Year/{tahun}', [PengeluaranController::class, 'getPengeluaraByDateIn1Year']);
Route::get('totalPengeluaranIn1Year/{tahun}', [PengeluaranController::class, 'totalPengeluaranIn1Year']);
Route::get('getPengeluaranByYear/{tahun}', [PengeluaranController::class, 'getPengeluaranByYear']);
Route::get('totalIuranIn1Year/{tahun}', [PembayaranIuranController::class, 'totalIuranIn1Year']);

Route::get('totalWarga', [WargaController::class, 'totalWarga']);
Route::get('totalRumah', [RumahController::class, 'totalRumah']);


