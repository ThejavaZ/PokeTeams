<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\PokemonsController;
use \App\Http\Controllers\Api\TeamsController;
use \App\Http\Controllers\Api\TrainersController;
use \App\Http\Controllers\Api\TypesController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('pokemons',[PokemonsController::class, 'index']);
Route::post('pokemons/create',[PokemonsController::class, 'create']);
Route::get('pokemons/{id}',[PokemonsController::class, 'show']);
Route::post('pokemons/{id}/edit',[PokemonsController::class, 'edit']);
Route::post('pokemons/{id}',[PokemonsController::class, 'destroy']);

Route::get('teams',[TeamsController::class, 'index']);
Route::post('teams/create',[TeamsController::class, 'create']);
Route::get('teams/{id}',[TeamsController::class, 'show']);
Route::post('teams/{id}/edit',[TeamsController::class, 'edit']);
Route::post('teams/{id}',[TeamsController::class, 'destroy']);

Route::get('trainers',[TrainersController::class, 'index']);
Route::post('trainers/create',[TrainersController::class, 'create']);
Route::get('trainers/{id}',[TrainersController::class, 'show']);
Route::post('trainers/{id}/edit',[TrainersController::class, 'edit']);
Route::post('trainers/{id}',[TrainersController::class, 'destroy']);


Route::get('types',[TypesController::class, 'index']);
Route::post('types/create',[TypesController::class, 'create']);
Route::get('types/{id}',[TypesController::class, 'show']);
Route::post('types/{id}/edit',[TypesController::class, 'edit']);
Route::post('types/{id}',[TypesController::class, 'destroy']);

