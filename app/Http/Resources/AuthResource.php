<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    private int $statusCode;
    private string $token;
    private User $user;

    public function __construct(User $user, string $token,  int $statusCode = 200)
    {
        $this->statusCode = $statusCode;
        $this->token = $token;
        $this->user = $user;
        parent::__construct($user);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => [
                'token' => $this->token,
                'user' => $this->user
            ],
        ];
    }

    public function withResponse($request, $response): void
    {
        $response->setStatusCode($this->statusCode);
    }
}
