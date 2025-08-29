<?php

namespace App\Traits;

use App\Models\User;
use App\Models\UserStatus;

trait UserTrait
{

    public static function managers()
    {
        $users = User::select('users.*')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->where('role_user.role_id', config('_my_config.role_manager_id'));
        if (auth()->user()->is_admin == 1) {
            $users = $users->where('users.id', auth()->id());
        }

        $users = $users->get();

        return $users;
    }

    public static function cses()
    {
        $users = User::select('users.*')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->where('role_user.role_id', config('_my_config.role_cs_id'));
        if (auth()->user()->is_admin == 1) {
            $users = $users->where('users.id', auth()->id());
        }

        $users = $users->get();

        return $users;
    }

    public static function userStatus()
    {
        return (new UserStatus())->get();
    }


}
