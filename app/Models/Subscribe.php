<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscribe extends AbstractModel
{
    use HasFactory;

    protected $fillable = ['email'];

    public function slugTo()
    {
        return false;
    }
}
