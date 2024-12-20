<?php

namespace App\QueryFilters\Ticket;

use App\Http\Requests\TicketRequest;
use Illuminate\Database\Eloquent\Builder;

class User
{
    public function __construct(
        protected TicketRequest $request
    )
    {
    }

    public function handle(Builder $builder, \Closure $next)
    {
        $userId = $this->request->getUserIdParam();

        return $next($builder)
            ->when($userId !== null, function (Builder $builder) use ($userId) {
                return $builder->where('user_id', '=', $userId);
            });
    }
}
