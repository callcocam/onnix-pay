<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Models;

use App\Models\Rifas\Rifa;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Contest extends AbstractModel
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'description' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rifas()
    {
        return $this->hasMany(Rifa::class);
    }
}
