<?php

namespace App\Models;

use App\Models\Rifas\Rifa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
