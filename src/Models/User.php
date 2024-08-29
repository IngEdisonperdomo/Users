<?php 

namespace App\Models;

class User {

  private string $name;
  private string $email;
  private string $passwordHash;
  private int $id;

  public function __construct(string $name, string $email, string $password) {
    $this->name = $name;
    $this->email = $email;
    $this->passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $this->id = random_int(1, 1000000);
  }

  // Getters
  public function getName(): string {
    return $this->name;
  }

  public function getEmail(): string {
    return $this->email;
  }

  public function getPasswordHash(): string {
    return $this->passwordHash;
  }

  // Setters
  public function setName(string $name): void {
    $this->name = $name;
  }

  public function setEmail(string $email): void {
    $this->email = $email;
  }

  public function setPassword(string $password): void {
    $this->passwordHash = password_hash($password, PASSWORD_DEFAULT);
  }

  // Verify password
  public function verifyPassword(string $password): bool {
    return password_verify($password, $this->passwordHash);
  }

  public function getId(): int {
    return $this->id;
  }
}