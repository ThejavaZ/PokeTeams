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
        return $this->hasMany(\App\Models\Pokemons::class);
    }
    public function trainers()
    {
        return $this->hasMany(\App\Models\Trainers::class);
    }
}
