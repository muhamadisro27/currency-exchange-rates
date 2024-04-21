<?php

namespace App\Observers;

use App\Helper\Str;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserObserver
{
    public $afterCommit = true;

    public function __construct(protected Str $str)
    {
    }

    public function created(User $user): void
    {
        $role = Role::where('name', request('role'))->first();

        $user->syncRoles($role->name);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
    }

        /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
        $user->roles()->detach();
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }


}
