<?php

namespace App\Traits;

use App\Models\User;
use App\Models\UserStatus;

trait UserTrait
{

    public static  function managers()
    {
        return User::select('users.*')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->where('role_user.role_id', config('_my_config.role_manager_id'))
            ->get();
    }

    public static  function cses()
    {
        return User::select('users.*')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->where('role_user.role_id', config('_my_config.role_cs_id'))
            ->get();
    }

    public static  function userStatus()
    {
        return (new UserStatus())->get();
    }


}
