<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\MahasiswaController;
use App\Http\Controllers\Backend\DosenController;
use App\Http\Controllers\Backend\KelasController;
use App\Http\Controllers\Backend\ProdiController;
use App\Http\Controllers\Backend\RuanganController;
use App\Http\Controllers\Backend\MatakuliahController;
use App\Http\Controllers\Backend\JadwalController;
use App\Http\Controllers\Backend\BeaconController;
use App\Http\Controllers\Backend\HariController;
use App\Http\Controllers\Backend\JenisIzinController;
use App\Http\Controllers\Backend\DataTableController;
use App\Http\Controllers\Backend\KrsController;
use App\Http\Controllers\Backend\PresensiController;
use App\Http\Controllers\Backend\BeritaAcaraController;







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



Auth::routes();
Route::group(['middleware' => ['admin:admin'] ], function() {
    Route::prefix('profil')->group(function(){
        Route::get('/',[AdminController::class, 'indexPassword'])->name('admin.index.password');
        Route::patch('reset-password',[AdminController::class, 'updatePassword'])->name('admin.update.password');
    });
    //Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::prefix('mahasiswa')->group(function () {
        Route::get('/',[MahasiswaController::class, 'index'])->name('mahasiswa.index');
        Route::post('/store',[MahasiswaController::class, 'store'])->name('mahasiswa.store');
        Route::post('/update/{id}',[MahasiswaController::class, 'update'])->name('mahasiswa.update');
        Route::delete('/delete/{id}',[MahasiswaController::class, 'destroy'])->name('mahasiswa.delete');
        Route::get('/datatable',[DataTableController::class, 'dataTableMahasiswa'])->name('mahasiswa.datatable');
    });
    
    Route::prefix('dosens')->group(function () {
        Route::get('/',[DosenController::class, 'index'])->name('dosens.index');
        Route::post('/store',[DosenController::class, 'store'])->name('dosens.store');
        Route::post('/update/{id}',[DosenController::class, 'update'])->name('dosens.update');
        Route::delete('/delete/{id}',[DosenController::class, 'destroy'])->name('dosens.delete');
        Route::get('/datatable',[DataTableController::class, 'dataTableDosen'])->name('dosens.datatable');
    });
    
    Route::prefix('kelas')->group(function () {
        Route::get('/',[KelasController::class, 'index'])->name('kelas.index');
        Route::post('/store',[KelasController::class, 'store'])->name('kelas.store');
        Route::put('/update/{id}',[KelasController::class, 'update'])->name('kelas.update');
        Route::delete('/delete/{id}',[KelasController::class, 'destroy'])->name('kelas.delete');
        Route::get('/datatable',[DataTableController::class, 'kelas'])->name('kelas.datatable');
    });

    Route::resource('admin',AdminController::class);
    Route::post('admin/update/{id}',[AdminController::class,'update']);

    Route::resource('hari', HariController::class);
    Route::resource('jenis-izin', JenisIzinController::class);
    Route::resource('krs',KrsController::class);

    Route::prefix('data')->group(function(){
        Route::get('/hari',[DataTableController::class,'hari'])->name('data.hari');
        Route::get('/jenis-izin',[DataTableController::class,'jenisIzin'])->name('data.jenis-izin');
        Route::get('/jadwal',[DataTableController::class, 'jadwal'])->name('data.jadwal');
        Route::get('/beacon/{id}',[DataTableController::class, 'beacon'])->name('data.beacon');
        Route::get('/krs',[DataTableController::class, 'krs'])->name('data.krs');
        Route::get('/admin',[DataTableController::class, 'admin'])->name('data.admin');
        Route::get('/presensi',[DataTableController::class, 'presensi'])->name('data.presensi');
        Route::get('/rekap-kehadiran',[DataTableController::class, 'rekapKehadiran'])->name('data.rekap-kehadiran');
    });
    
    Route::prefix('prodi')->group(function () {
        Route::get('/',[ProdiController::class, 'index'])->name('prodi.index');
        Route::post('/store',[ProdiController::class, 'store'])->name('prodi.store');
        Route::put('/update/{id}',[ProdiController::class, 'update'])->name('prodi.update');
        Route::delete('/delete/{id}',[ProdiController::class, 'destroy'])->name('prodi.delete');
        Route::get('/datatable',[DataTableController::class, 'prodi'])->name('prodi.datatable');
    });
    
    Route::prefix('ruangan')->group(function () {
        Route::get('/',[RuanganController::class, 'index'])->name('ruangan.index');
        Route::post('/store',[RuanganController::class, 'store'])->name('ruangan.store');
        Route::put('/update/{id}',[RuanganController::class, 'update'])->name('ruangan.update');
        Route::delete('/delete/{id}',[RuanganController::class, 'destroy'])->name('ruangan.delete');
        Route::get('/datatable',[DataTableController::class, 'ruangan'])->name('ruangan.datatable');
    });
    
    Route::prefix('matakuliah')->group(function () {
        Route::get('/',[MatakuliahController::class, 'index'])->name('matakuliah.index');
        Route::post('/store',[MatakuliahController::class, 'store'])->name('matakuliah.store');
        Route::put('/update/{id}',[MatakuliahController::class, 'update'])->name('matakuliah.update');
        Route::delete('/delete/{id}',[MatakuliahController::class, 'destroy'])->name('matakuliah.delete');
        Route::get('/datatable',[DataTableController::class, 'matakuliah'])->name('matakuliah.datatable');
    });
    
   
    Route::prefix('beacon')->group(function () {
        Route::get('/',[BeaconController::class, 'index'])->name('beacon.index');
        Route::get('/show/{id}',[BeaconController::class, 'show'])->name('beacon.show');
        Route::post('/store',[BeaconController::class, 'store'])->name('beacon.store');
        Route::put('/update/{id}',[BeaconController::class, 'update'])->name('beacon.update');
        Route::delete('/delete/{id}',[BeaconController::class, 'destroy'])->name('beacon.delete');
       
    });
   
    Route::get('/', function () {
        return view('dashboard');
    });

    Route::prefix('jadwal')->group(function () {
        Route::get('/',[JadwalController::class, 'index'])->name('jadwal.index');
        Route::post('/store',[JadwalController::class, 'store'])->name('jadwal.store');
        Route::put('/update/{id}',[JadwalController::class, 'update'])->name('jadwal.update');
        Route::delete('/delete/{id}',[JadwalController::class, 'destroy'])->name('jadwal.delete');
        
    });
    //presensi
    Route::resource('presensi', PresensiController::class);
    Route::put('generate/presensi/{id}', [PresensiController::class,'generate']);
    Route::put('status/presensi/{id}', [PresensiController::class,'updateStatus']);
    Route::get('cetak/presensi/{id}',[PresensiController::class,'cetakPresensi'])->name('presensi.cetak');
    //berita acara
    Route::resource('beritaacara', BeritaAcaraController::class);
    Route::get('cetak/beritaacara/{id}',[BeritaAcaraController::class,'cetakBeritaAcara'])->name('beritaacara.cetak');
});


Route::prefix('dosen')->name('dosen.')->group(function () {
    Route::group(['middleware' => ['dosen:dosen'] ], function() {  
        
        Route::get('/', function () {
            return view('dashboard');
        });
        Route::prefix('profil')->group(function(){
            Route::get('/',[AdminController::class, 'indexPassword'])->name('index.password');
            Route::patch('reset-password',[AdminController::class, 'updatePassword'])->name('update.password');
        });
        Route::prefix('jadwal')->group(function () {
            Route::get('/',[JadwalController::class, 'index'])->name('jadwal.index');
            Route::post('/store',[JadwalController::class, 'store'])->name('jadwal.store');
            Route::put('/update/{id}',[JadwalController::class, 'update'])->name('jadwal.update');
            Route::delete('/delete/{id}',[JadwalController::class, 'destroy'])->name('jadwal.delete');
            
        });
        Route::prefix('data')->group(function(){
            Route::get('/jadwal',[DataTableController::class, 'jadwal'])->name('data.jadwal');
            Route::get('/presensi',[DataTableController::class, 'presensi'])->name('data.presensi');
            Route::get('/rekap-kehadiran',[DataTableController::class, 'rekapKehadiran'])->name('data.rekap-kehadiran');
        });
        //presensi
        Route::resource('presensi', PresensiController::class);
        Route::put('generate/presensi/{id}', [PresensiController::class,'generate']);
        Route::put('status/presensi/{id}', [PresensiController::class,'updateStatus']);
        Route::get('cetak/presensi/{id}',[PresensiController::class,'cetakPresensi'])->name('presensi.cetak');
        //berita acara
        Route::resource('beritaacara', BeritaAcaraController::class);
        Route::get('cetak/beritaacara/{id}',[BeritaAcaraController::class,'cetakBeritaAcara'])->name('beritaacara.cetak');
    });
});
