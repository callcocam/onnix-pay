<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Models;

use App\Models\Rifas\Rifa;
use App\Models\Rifas\Sales\Sale;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Winner extends AbstractModel
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
 
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function slugTo()
    {
        return false;
    }
}
