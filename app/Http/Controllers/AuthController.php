<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\ErrorResource;
use App\Repositories\Contract\UserRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function __construct(private readonly UserRepositoryInterface $userRepository)
    {
    }

    public function getUser(Request $request) {
        return $request->user();
    }

    public function login(LoginRequest $request): ErrorResource|AuthResource
    {
        $email = $request->input('email');
        $password = $request->input('password');

        /* @var User $user */
        $user = $this->userRepository->getByField('email', $email);

        $isValid = $user && Hash::check($password, $user->getAuthPassword());

        if (!$isValid) {
            return new ErrorResource("Credenciales incorrectas");
        }

        $token = $user->createToken("")->plainTextToken;

        return new AuthResource($user, $token);
    }

    public function signup(CreateUserRequest $request): ErrorResource|AuthResource
    {
        try {
            $user = $request->validated();

            $user['password'] = Hash::make($user['password']);

            /* @var User $newUser */
            $newUser = $this->userRepository->create($user);

            $token = $newUser->createToken("")->plainTextToken;

            return new AuthResource($newUser, $token);
        } catch (Exception $exception) {
            return new ErrorResource(message: $exception->getMessage(), statusCode: 409);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Sesión cerrada'
        ]);
    }
}
