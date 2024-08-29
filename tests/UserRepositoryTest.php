<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Exceptions\UserDoesNotExistException;

class UserRepositoryTest extends TestCase {
    private $userRepository;

    protected function setUp(): void {
        $this->userRepository = new UserRepository();
    }

    public function testSaveAndRetrieveUser(): void {
        $user = new User("John Doe", "john@example.com", "password123");
        $this->userRepository->save($user);

        $retrievedUser = $this->userRepository->getByIdOrFail("john@example.com");
        $this->assertEquals("John Doe", $retrievedUser->getName());
        $this->assertEquals("john@example.com", $retrievedUser->getEmail());
        $this->assertTrue(password_verify("password123", $retrievedUser->getPasswordHash()));
    }

    public function testWhenUserIsNotFoundByIdErrorIsThrown(): void {
        $this->expectException(UserDoesNotExistException::class);
        $this->userRepository->getByIdOrFail("nonexistent@example.com");
    }
}