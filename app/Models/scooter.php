<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scooter extends Model
{
    use HasFactory;

    public function Standort()
    {
        return $this->hasOne('App\Models\Standort');
    }

    public function Hersteller()
    {
        return $this->hasOne('App\Models\Hersteller');
    }

    public function Ausleihe()
    {
        return $this->belongsTo('App\Models\Ausleihe');
    }
}
