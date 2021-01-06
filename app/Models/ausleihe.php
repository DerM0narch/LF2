<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ausleihe extends Model
{
    use HasFactory;

    public function Scooter()
    {
        return $this->hasMany('App\Models\Scooter');
    }

    public function Tarif()
    {
        return $this->hasOne('App\Models\Scooter');
    }
}
