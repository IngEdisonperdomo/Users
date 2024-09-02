<?php 

namespace App\Repositories;

use App\Models\User;

interface UserRepositoryInterface {
    public function save(User $user);
    public function findById(string $id);
    public function update(string $id, User $user);
    public function delete(User $user);
}