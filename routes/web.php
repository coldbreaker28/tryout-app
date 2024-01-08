<?php

use App\Http\Controllers\Auth\MahasiswaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Components\AdminController;
use App\Http\Controllers\Components\SiswaController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/get-soal',                      [AdminController::class, 'getSoal'])->name('get.soal');

Route::get('login',                         [UserController::class, 'login'])->name('login');
Route::post('post-login',                   [UserController::class, 'loginUser'])->name('login.user');
Route::get('registration',                  [UserController::class, 'register'])->name('register');
Route::post('post-registration',            [UserController::class, 'registerUser'])->name('register.user');
Route::get('logout',                        [UserController::class, 'logout'])->name('logout');

Route::post('post-register-mahasiswa',              [MahasiswaController::class, 'registerMahasiswa'])->name('register.mahasiswa');
Route::post('post-login-mahasiswa',                 [MahasiswaController::class, 'loginMahasiswa'])->name('login.mahasiswa');


Route::get('admin/dashboard',                       [AdminController::class, 'index'])->name('admin.home');
Route::get('admin/kelola-ujian',                    [AdminController::class, 'ujian'])->name('admin.ujian');
Route::get('admin/Buat-soal',                       [AdminController::class, 'buat_soal'])->name('admin.buat.soal');
Route::post('admin/Store_soal',                     [AdminController::class, 'store_soal'])->name('admin.store.soal');
Route::get('admin/soal/{id}',                       [AdminController::class, 'showSoal'])->name('admin.soal');
Route::get('admin/soal/edit/{id}',                  [AdminController::class, 'editSoal'])->name('admin.soal.edit');
Route::PUT('admin/soal/update/{id}',                [AdminController::class, 'updateSoal'])->name('admin.soal.update');
Route::DELETE('admin/soal/hapus/{id}',              [AdminController::class, 'hapusSoal'])->name('admin.soal.hapus');
Route::get('admin/kelola-peserta-ujian',            [AdminController::class, 'indexPeserta'])->name('admin.peserta');
Route::get('admin/detail/peserta-ujian/{id}',       [AdminController::class, 'showPeserta'])->name('admin.peserta.detail');
Route::get('admin/peserta-ujian/edit/{id}',         [AdminController::class, 'editPeserta'])->name('admin.peserta.edit');
Route::put('admin/peserta-ujian/update/{id}',       [AdminController::class, 'updatePeserta'])->name('admin.peserta.update');
Route::delete('admin/peserta-ujian/hapus/{id}',     [AdminController::class, 'hapusPeserta'])->name('admin.peserta.hapus');

Route::get('admin/laporan',                         [AdminController::class, 'indexLaporan'])->name('admin.laporan');

Route::get('mahasiswa/home',                                            [SiswaController::class, 'indexHome'])->name('mahasiswa.home');
Route::get('mahasiswa/home/profile',                                    [SiswaController::class, 'profileMahasiswa'])->name('mahasiswa.profile');
Route::get('mahasiswa/ujian',                                           [SiswaController::class, 'ujianMahasiswa'])->name('mahasiswa.ujian');
Route::POST('mahasiswa/ujian/kirim',                                    [SiswaController::class, 'submitJawaban'])->name('submit.jawaban');
Route::Get('mahasiswa/nilai',                                          [SiswaController::class, 'nilaiMahasiswa'])->name('mahasiswa.nilai');