<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }
}
