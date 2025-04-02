<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::get('pokemons',[\App\Http\Controllers\Api\PokemonsController::class, 'todos']);
Route::resource('pokemons', \App\Http\Controllers\Api\PokemonsController::class);
Route::resource('teams', \App\Http\Controllers\Api\TeamsController::class);
Route::resource('types',\App\Http\Controllers\Api\TypesController::class);
Route::resource('trainers',\App\Http\Controllers\Api\TrainerController::class);