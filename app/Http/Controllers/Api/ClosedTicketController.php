<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Http\Resources\TicketResource;
use App\Repositories\TicketRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class ClosedTicketController extends Controller
{
    public function __construct(
        private readonly TicketRepository $ticketRepository
    )
    {
    }

    public function __invoke(TicketRequest $request): AnonymousResourceCollection
    {
        return TicketResource::collection(
            $this->ticketRepository->getPaginatedList(
                processed: true,
                perPage: $request->get('limit', 10)
            )
        );
    }
}
