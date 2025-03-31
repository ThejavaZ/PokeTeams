<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainers extends Model
{
    protected $fillable = [
        "name",
        "region",
        "status",
        "created_at",
        "updated_at"
    ];
}
