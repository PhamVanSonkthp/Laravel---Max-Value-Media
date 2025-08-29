<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class WebsitePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\  $websites
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.websites-list'));
    }

    public function viewZone(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.websites-list-zone'));
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.websites-add'));
    }
    public function createZone(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.websites-add-zone'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\  $websites
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.websites-edit'));
    }
    public function updateZone(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.websites-edit-zone'));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\  $websites
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.websites-delete'));
    }
    public function deleteZone(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.websites-delete-zone'));
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\  $websites
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, $websites)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\  $websites
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, $websites)
    {
        //
    }
}
