<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Models\Rifas;

use App\Models\AbstractModel;
use App\Models\Contest;
use App\Models\Rifas\Sales\Sale;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rifa extends AbstractModel
{
    use HasFactory;

    protected $appends = ['priceBrl','totalBrl'];

    protected $casts = [
        'gallery' => 'array'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sale()
    {
        return $this->hasOne(Sale::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }

    public function getPriceBrlAttribute()
    {
        return number_format($this->price, 2, ',', '.');
    }

    public function getTotalBrlAttribute()
    {
        return number_format($this->total, 2, ',', '.');
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
