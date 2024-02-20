<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Models\Rifas\Sales;

use App\Models\AbstractModel;
use App\Models\Cupon;
use App\Models\Rifas\Rifa;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends AbstractModel
{
    use HasFactory;

    public function rifa()
    {
        return $this->belongsTo(Rifa::class);
    }

    public function numbers()
    {
        return $this->hasMany(Number::class);
    }

    protected function slugFrom()
    {
        return 'description';
    }

    public function cupons()
    {
        return $this->hasMany(Cupon::class);
    }
}
