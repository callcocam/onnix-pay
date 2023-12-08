<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Models\Rifas;

use App\Models\AbstractModel;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Category extends AbstractModel
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function rifas()
    {
        return $this->hasMany(Rifa::class);
    }
}
