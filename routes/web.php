<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\HistoryController;

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

// Route::get('/', function () {
//     return view('home.index');
// });
Route::get('/',[AuthController::class,'index']);
Route::post('/auth',[AuthController::class,'auth'])->name('auth');
Route::get('/home',[HomeController::class,'index'])->name('home');
Route::get('/buku',[BukuController::class,'index'])->name('buku');
Route::get('/get_list_buku',[BukuController::class,'get_list_buku'])->name('get_list_buku');
Route::get('/listbuku',[BukuController::class,'listbuku'])->name('listbuku');
Route::post('/store-buku',[BukuController::class,'store_buku'])->name('store-buku');
Route::get('/anggota',[AnggotaController::class,'index'])->name('anggota');
Route::post('/store_anggota',[AnggotaController::class,'store_anggota'])->name('store_anggota');
Route::get('/get_list_anggota',[AnggotaController::class,'get_list_anggota'])->name('get_list_anggota');
Route::get('/stock',[StockController::class,'index'])->name('stock');
Route::get('/get_list_stock',[StockController::class,'get_list_stock'])->name('get_list_stock');
Route::get('/history',[HistoryController::class,'index'])->name('history');
Route::get('/get_list_history',[HistoryController::class,'get_list_history'])->name('get_list_history');
Route::get('/pinjam',[PinjamController::class,'index'])->name('pinjam');
Route::get('/get_transaction',[PinjamController::class,'get_transaction_pinjam'])->name('get_transaction');
Route::get('/edit-transaction/{id}',[PinjamController::class,'edit_trans_pinjam']);
Route::post('view_trans',[PinjamController::class,'view_trans'])->name('view_trans');
Route::get('/create-transaction',[PinjamController::class,'create_trans_pinjam'])->name('create-transaction');
Route::post('/store-transaction',[PinjamController::class,'store_transaction'])->name('store-transaction');
Route::post('/update_trans_pinjam',[PinjamController::class,'update_trans_pinjam'])->name('update_trans_pinjam');
Route::post('/check-stock',[PinjamController::class,'check_stock'])->name('check-stock');
// report
Route::get('/report-stock',[StockController::class,'report_stock'])->name('report-stock');
