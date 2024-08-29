<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Models\User;

class UserTest extends TestCase {

    public function testGetEmail() {
        $user = new User("John Doe", "john@example.com", "password123");
        $this->assertEquals("john@example.com", $user->getEmail());
    }

    public function testGetPasswordHash() {
        $user = new User("John Doe", "john@example.com", "password123");
        $this->assertTrue(password_verify("password123", $user->getPasswordHash()));
    }

    public function testSetName() {
        $user = new User("John Doe", "john@example.com", "password123");
        $user->setName("Jane Doe");
        $this->assertEquals("Jane Doe", $user->getName());
    }

    public function testSetEmail() {
        $user = new User("John Doe", "john@example.com", "password123");
        $user->setEmail("jane@example.com");
        $this->assertEquals("jane@example.com", $user->getEmail());
    }

    public function testSetPassword() {
        $user = new User("John Doe", "john@example.com", "password123");
        $user->setPassword("newpassword123");
        $this->assertTrue(password_verify("newpassword123", $user->getPasswordHash()));
    }

    public function testVerifyPassword() {
        $user = new User("John Doe", "john@example.com", "password123");
        $this->assertTrue($user->verifyPassword("password123"));
        $this->assertFalse($user->verifyPassword("wrongpassword"));
    }
}