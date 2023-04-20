<?php

namespace App\interfaces;

interface UserRepositoryInterface
{
    public function getAllUsers();
    public function getAll($data);
    public function getUsersByRole($role);
    public function getUserById($userId);
    public function deleteOrder($userId);
    public function createUser(array $userDetails);
    public function updateUser($userId, array $userDetails);
}
