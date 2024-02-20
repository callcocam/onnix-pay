<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Rifas\Sales\Sale;
use Callcocam\Acl\Traits\HasUlids;
use Callcocam\Tenant\BelongsToTenants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Callcocam\Acl\Models\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUlids, BelongsToTenants, SoftDeletes;

    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function cupons()
    {
        return $this->hasMany(Cupon::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function orderDratf()
    {
        return $this->orders()->where('status', 'draft');
    }
}
