<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    use HasFactory;

    public function Ausleihe()
    {
        return $this->belongsTo('App\Models\Ausleihe');
    }
}
