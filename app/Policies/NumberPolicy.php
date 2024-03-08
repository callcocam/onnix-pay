<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Policies;

use App\Models\Rifas\Sales\Number;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NumberPolicy
{
    protected $permissions = 'admin.numbers';
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can(sprintf("%s.index", $this->permissions));
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Number $number): bool
    {
        return $user->can(sprintf("%s.show", $this->permissions));
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(sprintf("%s.create", $this->permissions));
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Number $number): bool
    {
        return $user->can(sprintf("%s.edit", $this->permissions));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Number $number): bool
    {
        return $user->can(sprintf("%s.delete", $this->permissions));
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Number $number): bool
    {
        return $user->can(sprintf("%s.restore", $this->permissions));
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Number $number): bool
    {
        return $user->can(sprintf("%s.forceDelete", $this->permissions));
    }
}
