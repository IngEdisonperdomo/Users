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
            $request->getPassword(),
        );

        return $this->userRepository->save($user);
    }

    public function getUserRepository(): UserRepositoryInterface {
        return $this->userRepository;
    }

    public function setUserRepository(UserRepositoryInterface $userRepository): void {
        $this->userRepository = $userRepository;
    }

    public function getUserById(string $id) {
        return $this->userRepository->findById($id);
    }


    public function getAllUsers(): array {
        return $this->userRepository->findAll();
    }

    public function updateUser(string $id, CreateUserRequest $request) {
        
        $user = $this->userRepository->findById($id);

        if(!empty($user)) {
            $user = new User(
                $request->getName(),
                $request->getEmail(),
                $request->getPassword(),
            );

            return $this->userRepository->update($id,$user);
        }else {
            return "User not found";
        }
    }




}