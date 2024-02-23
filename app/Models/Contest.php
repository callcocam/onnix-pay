<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Models;

use App\Core\Helpers\Helpers;
use App\Models\Rifas\Rifa;
use App\Models\Rifas\Sales\Sale;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Contest extends AbstractModel
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'description' => 'array',
    ];

    protected $appends = ['drawn'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function getDrawnAttribute()
    {
        return Helpers::date_carbom_format($this->drawn_at)->format('d/m/Y');
    }
}
