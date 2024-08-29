<?php

require 'vendor/autoload.php';

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

echo "User created successfully!";