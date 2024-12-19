<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\TicketRepository;
use App\Repositories\UserRepository;

class StatsController extends Controller
{
    public function __construct(
        private readonly TicketRepository $ticketRepository,
        private readonly UserRepository   $userRepository
    )
    {
    }

    public function __invoke(): array
    {
        return [
            'total_tickets' => $this->ticketRepository->count(),
            'unprocessed_tickets' => $this->ticketRepository->countUnprocessed(),
            'top_user' => $this->userRepository->getTopUser(),
            'last_processed' => $this->ticketRepository->getLastProcessed(),
        ];
    }
}
