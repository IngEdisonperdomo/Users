<?php

namespace App\Repositories;

use App\Models\User;
use App\Exceptions\UserDoesNotExistException;

class UserRepository implements UserRepositoryInterface {
    private array $users = [];

    public function save(User $user): void {
        $this->users[$user->getEmail()] = $user;
    }

    public function getByIdOrFail(string $email): User {
      if (isset($this->users[$email])) {
          return $this->users[$email];
      } else {
          throw new UserDoesNotExistException();
      }
  }

    public function update(User $user): void {
        if (isset($this->users[$user->getEmail()])) {
            $this->users[$user->getEmail()] = $user;
        } else {
            throw new UserDoesNotExistException();
        }
    }

    public function delete(User $user): void {
        if (isset($this->users[$user->getEmail()])) {
            unset($this->users[$user->getEmail()]);
        } else {
            throw new UserDoesNotExistException();
        }
    }
}