<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Exceptions\UserDoesNotExistException;
use Mockery;

class UserRepositoryTest extends TestCase {
    private $userRepository;
    private $userMock;

    protected function setUp(): void {
        $this->userMock = Mockery::mock(User::class);
        $this->userRepository = Mockery::mock(UserRepository::class)->makePartial();
    }

    protected function tearDown(): void {
        Mockery::close();
    }

    public function testSaveAndRetrieveUser(): void {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => password_hash('password123', PASSWORD_DEFAULT)
        ];

        $this->userMock->shouldReceive('getName')->andReturn($userData['name']);
        $this->userMock->shouldReceive('getEmail')->andReturn($userData['email']);
        $this->userMock->shouldReceive('getPassword')->andReturn($userData['password']);

        $this->userRepository->shouldReceive('save')
            ->with(Mockery::on(function($user) use ($userData) {
                return $user->getName() === $userData['name'] &&
                       $user->getEmail() === $userData['email'] &&
                       password_verify('password123', $user->getPassword());
            }))
            ->andReturn($this->userMock);

        $this->userRepository->shouldReceive('getByIdOrFail')
            ->with($userData['email'])
            ->andReturn($this->userMock);

        $this->userRepository->save($this->userMock);
        $retrievedUser = $this->userRepository->getByIdOrFail($userData['email']);

        $this->assertEquals($userData['name'], $retrievedUser->getName());
        $this->assertEquals($userData['email'], $retrievedUser->getEmail());
        $this->assertTrue(password_verify('password123', $retrievedUser->getPassword()));
    }

    public function testWhenUserIsNotFoundByIdErrorIsThrown(): void {
        $this->userRepository->shouldReceive('getByIdOrFail')
            ->with('nonexistent@example.com')
            ->andThrow(UserDoesNotExistException::class);

        $this->expectException(UserDoesNotExistException::class);
        $this->userRepository->getByIdOrFail('nonexistent@example.com');
    }

         
}