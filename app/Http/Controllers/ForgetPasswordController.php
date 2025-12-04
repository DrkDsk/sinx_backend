<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Resources\EmailResource;
use App\Http\Resources\ErrorResource;
use App\Repositories\Contract\UserRepositoryInterface;
use Illuminate\Support\Facades\Password;

class ForgetPasswordController extends Controller
{
    public function __construct(private readonly UserRepositoryInterface $userRepository)
    {
    }

    public function sendResetLink(ForgetPasswordRequest $request): EmailResource|ErrorResource
    {
        $user = $this->userRepository->getByField('email', $request->validated('email'));

        if (!$user) {
            return new ErrorResource('Este correo no se encuentra registrado');
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );

        $actionMessage = __($status);

        if ($status !== Password::RESET_LINK_SENT) {
            return new ErrorResource("$actionMessage");
        }

        return new EmailResource($actionMessage);
    }
}
