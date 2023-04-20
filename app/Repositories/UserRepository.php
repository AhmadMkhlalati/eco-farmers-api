<?php

namespace App\Repositories;

use App\Models\User;
use Spatie\Permission\Models\Role;

class UserRepository implements \App\interfaces\UserRepositoryInterface
{

    public function getAllUsers()
    {
        return User::all();
    }

    public function getUserById($userId)
    {
        return User::findOrFail($userId);
    }

    public function deleteOrder($userId)
    {
        User::destroy($userId);
    }

    public function createUser(array $userDetails)
    {
       return User::create($userDetails);
    }

    public function updateUser($userId, array $userDetails)
    {
        return User::whereId($userId)->update($userDetails);
    }

    public function getAll($data =[])
    {
        return User::query()
            ->with(['roles'])->select('*');
    }

    public function getUsersByRole($role)
    {
        $roles = Role::pluck('name')->toArray();
    }
}
