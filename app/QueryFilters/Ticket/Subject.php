<?php

namespace App\QueryFilters\Ticket;

use App\Http\Requests\TicketRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Subject
{
    public function __construct(
        protected TicketRequest $request
    )
    {
    }

    public function handle(Builder $builder, \Closure $next)
    {
        return $next($builder)
            ->when($this->request->has('subject'), function (Builder $builder) {
                $subject = '%' . $this->request->getSubjectParam() . '%';

                return $builder->where('subject', 'like', $subject);
            });
    }
}
