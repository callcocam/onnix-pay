<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
 namespace Callcocam\Profile\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Image extends AbstractProfileModel
{
    use HasFactory;

    public function imageable()
    {
        return $this->morphTo();
    }

    protected function slugTo()
    {
        return false;
    }

}
