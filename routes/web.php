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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::patch('/users/{id}/makeAdmin', [UserController::class, 'makeAdmin'])->name('users.makeAdmin');
    Route::patch('/users/{id}/makeOperator', [UserController::class, 'makeOperator'])->name('users.makeOperator');
    Route::patch('/users/{id}/makePeminjam', [UserController::class, 'makePeminjam'])->name('users.makePeminjam');
});

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::resource('ruangans', \App\Http\Controllers\RuanganController::class);
});

Route::middleware(['auth', 'verified', 'role:admin|operator|peminjam'])->group(function () {
    Route::resource('peminjamans', \App\Http\Controllers\PeminjamanController::class);
    Route::patch('peminjamans/verify/{id}', [\App\Http\Controllers\PeminjamanController::class, 'verify'])->name('peminjamans.verify');
    Route::patch('peminjamans/reject/{id}', [\App\Http\Controllers\PeminjamanController::class, 'reject'])->name('peminjamans.reject');
    Route::get('cetak-peminjaman', [\App\Http\Controllers\PdfController::class, 'peminjaman'])->name('cetak-peminjaman');
    Route::get('cetak-suratpeminjaman/{id}', [\App\Http\Controllers\PdfController::class, 'peminjamanbyid'])->name('cetak-suratpeminjaman');
    Route::get('cetak-suratpersetujuan/{id}', [\App\Http\Controllers\PdfController::class, 'suratpersetujuanbyid'])->name('cetak-suratpersetujuan');
    Route::get('cetak-laporan-status', [\App\Http\Controllers\PdfController::class, 'cetakStatus'])->name('cetak-laporan-status');
    Route::get('cetak-laporan-waktu', [\App\Http\Controllers\PdfController::class, 'cetakWaktu'])->name('cetak-laporan-waktu');
    Route::get('cetak-lappem-peminjam', [\App\Http\Controllers\PdfController::class, 'cetakPeminjaman'])->name('cetak-lappem-peminjam');
});

Route::middleware('auth')->group(function () {
    Route::resource('pembatalans', \App\Http\Controllers\PembatalanController::class);
    Route::get('cetak-pembatalan', [\App\Http\Controllers\PdfController::class, 'pembatalan'])->name('cetak-pembatalan');
});

Route::middleware('auth')->group(function () {
    Route::resource('pengembalians', \App\Http\Controllers\PengembalianController::class);
    Route::get('cetak-pengembalian', [\App\Http\Controllers\PdfController::class, 'pengembalian'])->name('cetak-pengembalian');
});

Route::middleware('auth')->group(function () {
    Route::resource('perubahanjadwals', \App\Http\Controllers\PerubahanJadwalController::class);
    Route::patch('perubahanjadwals/verify/{id}', [\App\Http\Controllers\PerubahanJadwalController::class, 'verify'])->name('perubahanjadwals.verify');
    Route::patch('perubahanjadwals/reject/{id}', [\App\Http\Controllers\PerubahanJadwalController::class, 'reject'])->name('perubahanjadwals.reject');
    Route::get('cetak-perubahanjadwal', [\App\Http\Controllers\PdfController::class, 'perubahanjadwal'])->name('cetak-perubahanjadwal');
});

Route::middleware(['auth', 'verified', 'role:admin|peminjam'])->group(function () {
    Route::resource('barangrusak', \App\Http\Controllers\BarangRusakController::class);
    Route::get('cetak-barangrusak', [\App\Http\Controllers\PdfController::class, 'barangrusak'])->name('cetak-barangrusak');
    Route::get('cetak-laporanbarangrusak/{id}', [\App\Http\Controllers\PdfController::class, 'barangrusakbyid'])->name('cetak-laporanbarangrusak');
    Route::get('cetak-hisbar-ruangan', [\App\Http\Controllers\PdfController::class, 'cetakBarangRusak'])->name('cetak-hisbar-ruangan');
});

Route::middleware('auth')->group(function () {
    Route::resource('maintenances', \App\Http\Controllers\MaintenanceController::class);
    Route::get('cetak-maintenance', [\App\Http\Controllers\PdfController::class, 'maintenance'])->name('cetak-maintenance');
});

Route::middleware(['auth', 'verified', 'role:admin|peminjam'])->group(function () {
    Route::resource('penilaianruangans', \App\Http\Controllers\PenilaianRuanganController::class);
    Route::get('cetak-penilaianruangan', [\App\Http\Controllers\PdfController::class, 'penilaianruangan'])->name('cetak-penilaianruangan');
    Route::get('cetak-beritaacarapenilaianruangan/{id}', [\App\Http\Controllers\PdfController::class, 'penilaianruanganbyid'])->name('cetak-beritaacarapenilaianruangan');
    Route::get('cetak-hisniru-ruangan', [\App\Http\Controllers\PdfController::class, 'cetakHisniruByRuangan'])->name('cetak-hisniru-ruangan');
    Route::get('cetak-hisniru-peminjam', [\App\Http\Controllers\PdfController::class, 'cetakHisniruByPeminjam'])->name('cetak-hisniru-peminjam');
    Route::get('/penilairanruangans/ruangans/{id}', [\App\Http\Controllers\PenilaianRuanganController::class, 'ruanganNilai'])->name('penilaianruangans.nilai');
    Route::post('penilaianruangans', [\App\Http\Controllers\PenilaianRuanganController::class, 'nilaiRuangan'])->name('penilaianruangans.nilaiRuangan');
});

Route::middleware(['auth', 'verified', 'role:admin|peminjam'])->group(function () {
    Route::resource('penilaianpetugas', \App\Http\Controllers\PenilaianPetugasController::class);
    Route::get('cetak-penilaianpetugas', [\App\Http\Controllers\PdfController::class, 'penilaianpetugas'])->name('cetak-penilaianpetugas');
    Route::get('cetak-beritaacarapenilaianpetugas/{id}', [\App\Http\Controllers\PdfController::class, 'penilaianpetugasbyid'])->name('cetak-beritaacarapenilaianpetugas');
    Route::get('cetak-hisnigas-petugas', [\App\Http\Controllers\PdfController::class, 'cetakHisnigasByPetugas'])->name('cetak-hisnigas-petugas');
    Route::get('/penilaianpetugas/petugas/{id}', [\App\Http\Controllers\PenilaianPetugasController::class, 'petugasNilai'])->name('penilaianpetugas.nilai');
    Route::post('penilaianpetugas', [\App\Http\Controllers\PenilaianPetugasController::class, 'nilaiPetugas'])->name('penilaianpetugas.nilaiPetugas');
});

require __DIR__ . '/auth.php';
