<?php
require 'vendor/autoload.php';

use Dotenv\Dotenv;
use App\DataBase\Connection;
use App\Repositories\UserRepository;
use App\UseCases\CreateUserUseCase;
use App\Controllers\UserController;

$dotenv = Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

// Enable CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: application/json');



$userRepository = new UserRepository();

$createUserUseCase = new CreateUserUseCase($userRepository);

$userController = new UserController($createUserUseCase);


// Simular una solicitud para crear un nuevo usuario
$requestData = [
  'name' => 'John Doe9',
  'email' => 'john@example.com',
  'password' => 'password9'
];

// Llamar al controlador para manejar la solicitud
//$userController->create($requestData);
//$userController->get("1");
//$userController->getAll();
//$userController->update('1', $requestData);


