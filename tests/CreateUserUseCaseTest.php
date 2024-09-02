<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Repositories\UserRepository;
use App\UseCases\CreateUserUseCase;
use App\Requests\CreateUserRequest;
use App\Models\User;
use Mockery;

class CreateUserUseCaseTest extends TestCase {
    private $userRepository;
    private $createUserUseCase;

    protected function setUp(): void {
        $this->userRepository = Mockery::mock(UserRepository::class);
        $this->createUserUseCase = new CreateUserUseCase($this->userRepository);
    }

    protected function tearDown(): void {
        Mockery::close();
    }

    public function testExecute(): void {
        $request = new CreateUserRequest("John Doe", "john@example.com", "password123");

        $userMock = Mockery::mock(User::class);
        $userMock->shouldReceive('getName')->andReturn("John Doe");
        $userMock->shouldReceive('getEmail')->andReturn("john@example.com");
        $userMock->shouldReceive('getPassword')->andReturn(password_hash("password123", PASSWORD_DEFAULT));

        $this->userRepository->shouldReceive('save')->once()->with(Mockery::type(User::class))->andReturn($userMock);
        $this->userRepository->shouldReceive('getByIdOrFail')->once()->with("john@example.com")->andReturn($userMock);

        $this->createUserUseCase->execute($request);

        $user = $this->userRepository->getByIdOrFail("john@example.com");
        $this->assertEquals("John Doe", $user->getName());
        $this->assertEquals("john@example.com", $user->getEmail());
        $this->assertTrue(password_verify("password123", $user->getPassword()));
    }
}