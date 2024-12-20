<?php

namespace App\QueryFilters\Ticket;

use App\Http\Requests\TicketRequest;
use Illuminate\Database\Eloquent\Builder;

class Content
{
    public function __construct(
        protected TicketRequest $request
    )
    {
    }

    public function handle(Builder $builder, \Closure $next)
    {
        $content = $this->request->getContentParam();

        return $next($builder)
            ->when($content !== null, function (Builder $builder) use ($content) {
                $subject = '%' . $content . '%';

                return $builder->where('content', 'like', $subject);
            });
    }
}
