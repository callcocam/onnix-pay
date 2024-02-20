<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Models;

use App\Models\Rifas\Sales\Sale;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Order extends AbstractModel
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function cupon() {
        return $this->belongsTo(Cupon::class);
    }

      /**
    * @return mixed
    */
    protected function slugTo()
    {
        return false;
    }
}
