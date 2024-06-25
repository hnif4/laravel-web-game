<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebVideosController;
use App\Http\Controllers\WebNewsController;
use App\Http\Controllers\WebProfileController;
use App\Http\Controllers\WebTrikController;
use App\Http\Controllers\VideosController;





Route::get('', function () {
    // Mendapatkan data dari kedua controller
    $webVideos = app(WebVideosController::class)->index();
    $webnews = app(WebNewsController::class)->index();
    $trik = app(WebTrikController::class)->index();
    $profile = app(WebProfileController::class)->index();
    

    // Mengembalikan view welcome sambil mengirimkan data dari kedua controller
    return view('welcome', ['webvideos' => $webVideos, 'webnews' => $webnews, 'webtrik'=> $trik, 'profile' => $profile ]);
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Merge webvideos and webnews into home route
Route::get('/webvideos', [WebVideosController::class, 'index']);
Route::get('/webnews', [WebNewsController::class, 'index']);
Route::get('/webprofile', [WebProfileController::class, 'index']);
Route::get('/webtrik', [WebTrikController::class, 'index']);



require __DIR__.'/auth.php';
