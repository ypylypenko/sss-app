<?php

namespace App\Repositories;

use App\QueryFilters\Ticket\Content;
use App\QueryFilters\Ticket\Subject;
use App\Models\Ticket;
use App\QueryFilters\Ticket\User;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Pipeline;

final class TicketRepository
{
    protected array $filters = [
        Content::class,
        User::class,
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

    public function count(): int
    {
        return Ticket::query()->count();
    }

    public function countUnprocessed(): int
    {
        return Ticket::query()
            ->where('status', false)
            ->count();
    }

    public function getLastProcessed(): ?Carbon
    {
        return Ticket::query()
            ->where('status', true)
            ->latest('updated_at')
            ->value('updated_at');
    }
}
