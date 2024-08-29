<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Repositories\UserRepository;
use App\UseCases\CreateUserUseCase;
use App\Requests\CreateUserRequest;

class CreateUserUseCaseTest extends TestCase {
    private $userRepository;
    private $createUserUseCase;

    protected function setUp(): void {
        $this->userRepository = new UserRepository();
        $this->createUserUseCase = new CreateUserUseCase($this->userRepository);
    }

    public function testExecute(): void {
        $request = new CreateUserRequest("John Doe", "john@example.com", "password123");
        $this->createUserUseCase->execute($request);

        $user = $this->userRepository->getByIdOrFail("john@example.com");
        $this->assertEquals("John Doe", $user->getName());
        $this->assertEquals("john@example.com", $user->getEmail());
        $this->assertTrue(password_verify("password123", $user->getPassword()));
    }
}