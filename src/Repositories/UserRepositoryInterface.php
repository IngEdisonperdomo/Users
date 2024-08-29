<?php 

namespace App\Repositories;

use App\Models\User;

interface UserRepositoryInterface {
    public function save(User $user): void;
    public function update(User $user): void;
    public function delete(User $user): void;
    public function getByIdOrFail(string $email): User;
}