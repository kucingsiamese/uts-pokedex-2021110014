<?php
use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;

Route::resource('pokemon', PokemonController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
