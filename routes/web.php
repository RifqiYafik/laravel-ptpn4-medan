<?php


use App\Http\Controllers\PenempatanController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\Asal_SekolahController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::resource('penempatan', PenempatanController::class)->middleware('auth');
Route::resource('asal_sekolah', Asal_SekolahController::class)->middleware('auth');
Route::resource('siswa', SiswaController::class)->middleware('auth');

Auth::routes(['register' => false]);  // register aktif atau tidak ada disini

Route::post('/siswas', [SiswaController::class, 'store'])->name('siswa.store');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [SiswaController::class, 'listsiswa']);
Route::get('/siswas/{id}', [SiswaController::class, 'detailSiswa'])->name('detail');
Route::get('/siswa/view/pdf', [SiswaController::class, 'view_pdf']);
// Route::get('/laporan-pdf', [SiswaController::class, 'laporan_pdf'])->name('laporan.pdf');



// use App\Http\Controllers\PenempatanController;
// use App\Http\Controllers\SiswaController;
// use App\Http\Controllers\Asal_SekolahController;
// use App\Models\Asal_Sekolah;
// use App\Models\Penempatan;
// use App\Models\Siswa;
// use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Auth;



// Route::resource('penempatan',PenempatanController::class);
// Route::resource('asal_sekolah',Asal_SekolahController::class);
// Route::resource('siswa',SiswaController::class);

// Route::resource('penempatan', PenempatanController::class)->middleware('auth');
// Route::resource('asal_sekolah', Asal_SekolahController::class)->middleware('auth');
// Route::resource('siswa', SiswaController::class)->middleware('auth');
// Auth::routes(['register'=>true]);

// Route::post('/siswas', [SiswaController::class, 'store'])->name('siswa.store');
// Route::post('/sekolahs', [SiswaController::class, 'store'])->name('asal_sekolah.store');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/', [SiswaController::class, 'listsiswa']);
// Route::get('/siswas/{id}', [SiswaController::class, 'detailSiswa'])->name('detail');
