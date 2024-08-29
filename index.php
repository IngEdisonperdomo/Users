<?php

require 'vendor/autoload.php';

// Enable CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: application/json');


use App\Repositories\UserRepository;
use App\UseCases\CreateUserUseCase;
use App\Controllers\UserController;

// Crear instancias de los objetos necesarios
$userRepository = new UserRepository();
$createUserUseCase = new CreateUserUseCase($userRepository);
$userController = new UserController($createUserUseCase);

// Simular una solicitud para crear un nuevo usuario
$requestData = [
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'password' => 'password123'
];

// Llamar al controlador para manejar la solicitud
$userController->create($requestData);

