<?php 
namespace App\Models;


class User {

  private string $name;
  private string $email;
  private string $passwordHash;

  public function __construct(string $name, string $email, string $password) {
    $this->name = $name;
    $this->email = $email;
    $this->passwordHash = password_hash($password, PASSWORD_DEFAULT);
    
  }

  public function getName(): string {
    return $this->name;
  }

  public function getEmail(): string {
    return $this->email;
  }

  public function getPassword(): string {
    return $this->passwordHash;
  }

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

  
}