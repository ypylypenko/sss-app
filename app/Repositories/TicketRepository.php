<?php

namespace App\Repositories;

use App\QueryFilters\Ticket\Subject;
use App\Models\Ticket;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Pipeline;

final class TicketRepository
{
    protected array $filters = [
        Subject::class
    ];

    public function getPaginatedList(bool $processed, int $perPage = 10): Paginator
    {
        $query = Ticket::query()
            ->with(['user'])
            ->where('status', '=', $processed);

        $query = Pipeline::send($query)
            ->through($this->filters)
            ->thenReturn();

        return $query->orderBy('created_at', 'DESC')->paginate($perPage);
    }
}
