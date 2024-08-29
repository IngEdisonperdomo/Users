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

    public function execute(CreateUserRequest $request) {
        $user = new User(
            $request->getName(),
            $request->getEmail(),
            $request->getPassword()
        );

        $this->userRepository->save($user);
        
        unset($user->password);

        return $request;
    }

    public function getUserRepository(): UserRepositoryInterface {
        return $this->userRepository;
    }

    public function setUserRepository(UserRepositoryInterface $userRepository): void {
        $this->userRepository = $userRepository;
    }

    public function getUserById(int $id): User {
        return $this->userRepository->findById($id);
    }

    public function getAllUsers(): array {
        return $this->userRepository->findAll();
    }

    public function updateUser(int $id, CreateUserRequest $request): void {
        $user = $this->userRepository->findById($id);

        $user->setName($request->getName());
        $user->setEmail($request->getEmail());
        $user->setPassword($request->getPassword());

        $this->userRepository->update($user);
    }




}