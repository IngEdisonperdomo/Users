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

Flight::route('GET /user', [$userController, 'getAll']);
Flight::route('POST /user', function() use ($userController) {
  $requestData = json_decode(file_get_contents('php://input'), true);
  $userController->create($requestData);
});
Flight::route('GET /user/@id', function($id) use ($userController) {
  $userController->get($id);
});
Flight::route('PUT /user/@id', function($id) use ($userController) {
  $requestData = json_decode(file_get_contents('php://input'), true);
  $userController->update($id, $requestData);
});

Flight::start();




