<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Rifas\Sales\Sale;
use Callcocam\Acl\Concerns\HasProfilePhoto;
use Callcocam\Acl\Traits\HasUlids;
use Callcocam\Tenant\BelongsToTenants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Callcocam\Acl\Models\Auth\User as Authenticatable;
use Callcocam\Acl\Models\Role;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable  implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, HasUlids, BelongsToTenants, SoftDeletes;

    use Billable;
    use HasProfilePhoto;

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

    protected $appends = ['billet_email', 'pix_email', 'card_email', 'profile_photo_url'];

    public function canAccessTenant(Model $tenant): bool
    {
        return  auth()->user()->can('admin.dashboard');
    }

    
    public function canAccessPanel(Panel $panel): bool
    {
        return  auth()->user()->can('admin.dashboard');
    }
    
    public function profilePhoto()
    {
        return  $this->getAttribute('cover') ;
    }

    public function getbilletEmailAttribute($value)
    {
        return $value ?? $this->email;
    }

    public function getPixEmailAttribute($value)
    {
        return $value ?? $this->email;
    }

    public function getCardEmailAttribute($value)
    {
        return $value ?? $this->email;
    }

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
        return $this->hasMany(Sale::class) ;
    }

    public function orderDratf()
    {
        return $this->orders()->where('status', 'draft');
    }

    public function orderPending()
    {
        return $this->orders()->where('status', 'pending');
    }

    public function orderProcessing()
    {
        return $this->orders()->where('status', 'processing');
    }

    public function orderPaid()
    {
        return $this->orders()->whereIn('status', ['paid', 'completed']);
    }

    
    public function scopeRoles(Builder $query, $role="super-admin"): void
    {
        $role = Role::where('slug', 'super-admin')->first();
        $roles = [];
        if($role){
            $roles = $role->users->pluck('id')->toArray();
        }
        $query->whereId('id', $roles);
    }
}
