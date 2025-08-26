<?php
 

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home\BannerController;
use App\Http\Controllers\Admin\KategoriController;


Route::get('/', function () {
    return redirect('/login');
});


//banner route
// Route::controller(BannerController::class)->group(function(){
//     Route::get('/banner/duzen1','HomeBanner')->name('banner');
//     Route::post('/banner/guncelle','BannerGuncelle')->name('banner.guncelle');

// });

//ktegori route
Route::controller(KategoriController::class)->group(function(){
    Route::get('/kategori/hepsi','KategoriHepsi')->name('kategori.hepsi');
    Route::get('/kategori/ekle','KategoriEkle')->name('kategori.ekle');
    Route::post('/kategori/ekle/form','KategoriEkleForm')->name('kategori.ekle.form');
    Route::get('/kategori/cevap/{id}','KategoriCevap')->name('kategori.cevap');
    Route::get('/kategori/duzenle/{id}','KategoriDuzenle')->name('kategori.duzenle');
    Route::post('/kategori/guncelle/form','KategoriGuncelleForm')->name('kategori.guncelle.form');

    Route::get('/kategori/sil/{id}','KategoriSil')->name('kategori.sil');

    Route::get('/kategori/gonderilen','KategoriGonderilen')->name('kategori.gonderilen');

    // Mesaj gönderme (AJAX)
    Route::post('/kategori/cevap/gonder','KategoriCevapGonder')->name('kategori.cevap.gonder');
    Route::post('/kategori/cevap/sil/{id}', 'KategoriCevapSil')->name('kategori.cevap.sil');

    Route::post('/kategori/durum-guncelle/{id}', [KategoriController::class, 'durumGuncelle'])
    ->name('kategori.durumGuncelle');

    Route::get('/kategori/yonlendir/{id}', [KategoriController::class, 'yonlendir'])->name('kategori.yonlendir');
    Route::get('/kategori/gelen', [KategoriController::class, 'gelenTalepler'])->name('kategori.gelen');





});




Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
