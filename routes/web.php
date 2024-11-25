<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\HeroController;


Route::get('/', function () {
    return view('home');
});

Route::get('/cari', [SearchController::class, 'search'])->name('search');
Route::get('/about', function () {
    return view('about');
});
Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/map', function () {
    return view('map');
})->name('map');

// Routes/web.php
Route::get('/cari-pahlawan', [HeroController::class, 'searchHero'])->name('hero.search');
Route::get('/heroes', [HeroController::class, 'allHeroes'])->name('hero.all');


