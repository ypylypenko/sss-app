<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory;

final class UserTicketController extends Controller
{
    public function __construct(
        private readonly UserRepository $userRepository
    )
    {
    }

    public function __invoke(Request $request, $email): JsonResponse|AnonymousResourceCollection
    {
        try {
            $user = $this->userRepository->findByEmail($email);

            return TicketResource::collection(
                $user->tickets()->paginate(perPage: $request->get('limit', 10))
            );
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'User not found',
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
