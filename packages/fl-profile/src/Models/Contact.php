<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

 namespace Callcocam\Profile\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends AbstractProfileModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    public function contactable()
    {
        return $this->morphTo();
    }

    protected function slugTo()
    {
        return false;
    }
}
