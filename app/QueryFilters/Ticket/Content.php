<?php

namespace App\QueryFilters\Ticket;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Content
{
    public function __construct(
        protected Request $request
    )
    {
    }

    public function handle(Builder $builder, \Closure $next)
    {
        return $next($builder)
            ->when($this->request->has('content'), function (Builder $builder) {
                $subject = '%' . $this->request->get('content') . '%';

                return $builder->where('content', 'like', $subject);
            });
    }
}
