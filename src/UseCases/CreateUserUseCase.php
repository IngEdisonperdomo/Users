<?php

namespace App\UseCases;

use App\Repositories\UserRepositoryInterface;
use App\Requests\CreateUserRequest;
use App\Models\User;

class CreateUserUseCase {
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function execute(CreateUserRequest $request): void {
        $user = new User(
            $request->getName(),
            $request->getEmail(),
            $request->getPassword()
        );

        $this->userRepository->save($user);
    }
}