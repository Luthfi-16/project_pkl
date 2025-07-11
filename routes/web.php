<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackendController;
use App\Http\Middleware\Admin;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\TransaksikasController;
use App\Http\Controllers\Backend\PembayaranController;
use App\Http\Controllers\Backend\KasmingguanController;
use App\Http\Controllers\Backend\ExportController;
use App\Http\Controllers\FrontendController;



Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [FrontendController::class, 'index'])->middleware('auth');

// Route untuk admin / backend
Route::group(['prefix' => 'admin', 'as' => 'backend.', 'middleware' => ['auth', Admin::class]], function () {
    Route::get('/', [BackendController::class, 'index']);
    Route::resource('/siswa', UserController::class);
    Route::resource('/transaksi', TransaksikasController::class);
    Route::resource('/pembayaran', PembayaranController::class);
    Route::resource('/kas', KasmingguanController::class);
    Route::get('/export', [ExportController::class, 'index'])->name('export.index');
});

Route::get('/select', function () {
    return view('select');
});