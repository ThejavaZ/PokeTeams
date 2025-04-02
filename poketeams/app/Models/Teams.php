<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    protected $fillable = [
        "name",
        "pokemon_id",
        "trainer_id",
        "status",
        "created_at",
        "updated_at",
    ];

    public function pokemons()
    {
        return $this->belongsTo(\App\Models\Pokemons::class, "pokemon_id");
    }
    public function trainers()
    {
        return $this->belongsTo(\App\Models\Trainers::class,"trainer_id");
    }
}
