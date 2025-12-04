<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    private User $user;
    private string $message;
    private int $statusCode;

    public function __construct(User $user, string $message, int $statusCode = 200)
    {
        $this->user = $user;
        $this->message = $message;
        $this->statusCode = $statusCode;

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
            'message' => $this->message,
            'data' => [
                'user' => $this->user,
            ]
        ];
    }

    public function withResponse(Request $request, JsonResponse $response)
    {
        $response->setStatusCode($this->statusCode);
    }
}
