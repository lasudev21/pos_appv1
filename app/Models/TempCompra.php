<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempCompra extends Model
{
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
