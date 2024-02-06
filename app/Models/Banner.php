<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Models;

use App\Models\Rifas\Rifa;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Banner extends AbstractModel
{
    use HasFactory;

    protected $appends = ['image_url'];

    public function addClick()
    {
        $this->clicks++;
        $this->save();
    }

    public function rifa()
    {
        return $this->belongsTo(Rifa::class);
    }

}
