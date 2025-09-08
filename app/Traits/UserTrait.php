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

    public static function csManageres()
    {
        $users = User::select('users.*')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->where('role_user.role_id', config('_my_config.role_cs_manager_id'));
        if (auth()->user()->is_admin == 1) {
            $users = $users->where('users.id', auth()->id());
        }

        $users = $users->get();

        return $users;
    }

    public static function isCSManager($user){
        if (empty($user)) return false;

        if (auth()->user()->is_admin == 2) return false;

        $csManageres = self::csManageres();
        foreach ($csManageres as $csManager){
            if ($user->id == $csManager->id) return true;
        }

        return false;
    }

    public static function isAdmin($user){
        if (empty($user)) return false;
        return $user->is_admin == 2;
    }

    public static function isCSChild($user){
        if (empty($user)) return false;

        if (auth()->user()->is_admin == 2) return false;

        $csChildren = self::csChildren();
        foreach ($csChildren as $csChild){
            if ($user->id == $csChild->id) return true;
        }

        return false;
    }

    public static function csChildren()
    {
        $users = User::select('users.*')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->where('role_user.role_id', config('_my_config.role_cs_child_id'));

        $users = $users->get();

        return $users;
    }

    public static function userStatus()
    {
        return (new UserStatus())->get();
    }


}
