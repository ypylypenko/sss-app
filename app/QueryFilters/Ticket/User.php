<?php

namespace App\QueryFilters\Ticket;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class User
{
    public function __construct(
        protected Request $request
    )
    {
    }

    public function handle(Builder $builder, \Closure $next)
    {
        return $next($builder)
            ->when($this->request->has('userId'), function (Builder $builder) {
                return $builder->where('userId', '=', $this->request->get('userId'));
            });
    }
}
