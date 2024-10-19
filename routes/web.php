<?php
use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokedexController;
use Illuminate\Container\Attributes\Auth;

Route::resource('pokemon', PokemonController::class);
Route::resource('pokemon', PokemonController::class)->middleware(middleware: 'auth');
Route::get(url: '/pokemons/create', action: [PokemonController::class]);

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', PokedexController::class);
