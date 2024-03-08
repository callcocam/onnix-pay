<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Callcocam\Tenant\Models;

use Callcocam\Profile\Traits\HasProfileModel; 
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AbstractTenantModel extends Model
{
    use SoftDeletes, HasProfileModel, HasUlids;

    public function __construct(array $attributes = [])
    {
        $this->connection = config('profile.connection', 'mysql');
        
        $this->incrementing = config('tenant.incrementing', true);

        $this->keyType = config('tenant.keyType', 'int');

        parent::__construct($attributes);
    }

    protected $guarded = [
        'id'
    ];

    public function scopeTenant(Builder $query): void
    {
          $query->where('id', auth()->user()->tenant_id);
    }
}
