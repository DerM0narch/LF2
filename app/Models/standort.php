<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Standort extends Model
{
    use HasFactory;

    public function Scooter()
    {
        return $this->belongsToMany('App\Models\Scooter');
    }
}
