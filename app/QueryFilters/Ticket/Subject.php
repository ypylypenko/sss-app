<?php

namespace App\QueryFilters\Ticket;

use App\Http\Requests\TicketRequest;
use Illuminate\Database\Eloquent\Builder;

class Subject
{
    public function __construct(
        protected TicketRequest $request
    )
    {
    }

    public function handle(Builder $builder, \Closure $next)
    {
        $subject = $this->request->getSubjectParam();

        return $next($builder)
            ->when($subject !== null, function (Builder $builder) use ($subject) {
                $subject = '%' . $subject . '%';

                return $builder->where('subject', 'like', $subject);
            });
    }
}
