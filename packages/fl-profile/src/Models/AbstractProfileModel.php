<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Callcocam\Profile\Models;

use Callcocam\Profile\Traits\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AbstractProfileModel extends Model
{
    use SoftDeletes, HasUlids;

    public function __construct(array $attributes = [])
    {
        $this->connection = config('profile.connection', 'mysql');
        
        $this->incrementing = config('profile.incrementing', true);

        $this->keyType = config('profile.keyType', 'int');

        parent::__construct($attributes);

        
    }

    protected $guarded = [
        'id'
    ];
}
