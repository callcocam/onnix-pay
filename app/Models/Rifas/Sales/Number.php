<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Models\Rifas\Sales;

use App\Models\AbstractModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Number extends AbstractModel
{
    use HasFactory;
 

    protected function slugTo()
    {
        return false;
    }
}
