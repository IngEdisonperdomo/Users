<?php

namespace App\Controllers;

use App\UseCases\CreateUserUseCase;
use App\Requests\CreateUserRequest;

class UserController {
    private CreateUserUseCase $createUserUseCase;

    public function __construct(CreateUserUseCase $createUserUseCase) {
        $this->createUserUseCase = $createUserUseCase;
    }

    
    public function create(array $requestData): void {
        $request = new CreateUserRequest(
            $requestData['name'],
            $requestData['email'],
            $requestData['password']
        );

        $this->createUserUseCase->execute($request);
    }
}