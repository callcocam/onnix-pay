<?php

namespace App\Models;

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


}
