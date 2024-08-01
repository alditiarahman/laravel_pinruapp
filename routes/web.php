<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('ruangans', \App\Http\Controllers\RuanganController::class);
});

Route::middleware('auth')->group(function () {
    Route::resource('peminjamans', \App\Http\Controllers\PeminjamanController::class);
    Route::patch('peminjamans/verify/{id}', [\App\Http\Controllers\PeminjamanController::class, 'verify'])->name('peminjamans.verify');
    Route::patch('peminjamans/reject/{id}', [\App\Http\Controllers\PeminjamanController::class, 'reject'])->name('peminjamans.reject');
});

Route::middleware('auth')->group(function () {
    Route::resource('pengembalians', \App\Http\Controllers\PengembalianController::class);
});

Route::middleware('auth')->group(function () {
    Route::resource('perubahanjadwals', \App\Http\Controllers\PerubahanJadwalController::class);
    Route::patch('perubahanjadwals/verify/{id}', [\App\Http\Controllers\PerubahanJadwalController::class, 'verify'])->name('perubahanjadwals.verify');
    Route::patch('perubahanjadwals/reject/{id}', [\App\Http\Controllers\PerubahanJadwalController::class, 'reject'])->name('perubahanjadwals.reject');
});

Route::middleware('auth')->group(function () {
    Route::resource('barangrusak', \App\Http\Controllers\BarangRusakController::class);
});

Route::middleware('auth')->group(function () {
    Route::resource('maintenances', \App\Http\Controllers\MaintenanceController::class);
});

Route::middleware('auth')->group(function () {
    Route::resource('penilaianruangans', \App\Http\Controllers\PenilaianRuanganController::class);
});

require __DIR__ . '/auth.php';
