<?php

namespace App\Controllers;

use App\Models\User;
use App\Requests\CreateUserRequest;
use App\UseCases\CreateUserUseCase;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="User Management System API",
 *     version="1.0.0",
 *     description="API documentation for the User Management System"
 * )
*/
class UserController {
    private $createUserUseCase;

    public function __construct(CreateUserUseCase $createUserUseCase) {
        $this->createUserUseCase = $createUserUseCase;
    }

    /**
     * @OA\Post(
     *     path="/user",
     *     summary="Create a new user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","email","password"},
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", example="john@example.com"),
     *             @OA\Property(property="password", type="string", example="password123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User created successfully"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function create(array $requestData) {
        $request = new CreateUserRequest(
            $requestData['name'],
            $requestData['email'],
            $requestData['password']
        );

        $this->createUserUseCase->execute($request);

        http_response_code(200);

        echo json_encode(['message' => 'User created successfully!', 'data' => $requestData]);
    }

    /**
     * @OA\Get(
     *     path="/user",
     *     summary="get a user by id",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id"},
     *             @OA\Property(property="id", type="string", example="1"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User found successfully"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function get(int $id) {
        $user = $this->createUserUseCase->getUserById($id);

        http_response_code(200);

        echo json_encode($user);
    }

    
    public function getAll() {
        $users = $this->createUserUseCase->getAllUsers();

        http_response_code(200);

        echo json_encode($users);
    }

    
    public function update(int $id, array $requestData) {
        $request = new CreateUserRequest(
            $requestData['name'],
            $requestData['email'],
            $requestData['password']
        );

        $this->createUserUseCase->updateUser($id, $request);

        http_response_code(200);

        echo json_encode(['message' => 'User updated successfully!', 'data' => $requestData]);
    }
}

