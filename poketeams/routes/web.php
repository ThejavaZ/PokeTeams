<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\PokemonsController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('index');

// Pokemons routes
Route::get('pokemons',[PokemonsController::class, 'index'])->name('pokemons');
Route::get('pokemons/create',[PokemonsController::class, 'create'])->name('pokemons.create');
Route::post('pokemons/store',[PokemonsController::class, 'store'])->name('pokemons.store');
Route::get('pokemons/{pokemon}',[PokemonsController::class, 'show'])->name('pokemons.show');
Route::get('pokemons/{pokemon}/edit',[PokemonsController::class, 'edit'])->name('pokemons.edit');
Route::put('pokemons/{pokemon}',[PokemonsController::class, 'update'])->name('pokemons.update');
Route::delete('pokemons/{pokemon}',[PokemonsController::class, 'destroy'])->name('pokemons.destroy');

// Teams routes
Route::resource('teams', \App\Http\Controllers\TeamsController::class);

// Types routes
Route::resource('types', \App\Http\Controllers\TypesController::class);
// Trainers teams
Route::resource('trainers', \App\Http\Controllers\TrainersController::class);