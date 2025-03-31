<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Pokemons extends Model
{
    protected $fillable =[
        "name",
        "mote",
        "type_id",
        "level",
        "status",
        "created_at",
        "updated_at"
    ];

    public function types()
    {
        return $this->belongsTo(\App\Models\Types::class, 'type_id');
    }
}
