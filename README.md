# User Management System

This project is a simple user management system implemented in PHP. It includes functionalities for creating, updating, and deleting users, as well as retrieving user information. The project follows a clean architecture with a separation of concerns between models, repositories, use cases, and controllers.

## Project Structure

```
root/
├── src/
│ ├── Controllers/
│ │ └── UserController.php
│ ├── Exceptions/
│ │ └── UserDoesNotExistException.php
│ ├── Models/
│ │ └── User.php
│ ├── Repositories/
│ │ ├── UserRepository.php
│ │ └── UserRepositoryInterface.php
│ ├── Requests/
│ │ └── CreateUserRequest.php
│ └── UseCases/
│ └── CreateUserUseCase.php
├── tests/
│ ├── UserTest.php
│ ├── UserRepositoryTest.php
│ └── CreateUserUseCaseTest.php
├── vendor/
│ └── autoload.php
├── composer.json
├── composer.lock
└── index.php
```

## Requirements

- PHP 7.4 or higher
- Composer

## Installation

1. Clone the repository:
   ```sh
   git clone https://github.com/yourusername/your-repo-name.git
   cd your-repo-name
   ```
2. Install dependencies using Composer
   ```sh
   composer install
   ```
3. Run the application, you can use the built-in PHP server
   ```sh
   php -S localhost:8000
   ```

## Running Tests

This project uses PHPUnit for testing. To run the tests, follow these steps:

1. Ensure you have PHPUnit installed. If not, you can install it globally using Composer

   ```sh
   composer global require phpunit/phpunit
   ```

2. Run the tests using the following command
   ```sh
   vendor\bin\phpunit
   ```

This project is licensed under the MIT License. See the LICENSE file for details

## Generating Swagger Documentation

To generate the Swagger documentation, run the following command

```sh
php generate-swagger.php
```

To view the Swagger documentation, open the swagger-ui/index.html file in your web browse
