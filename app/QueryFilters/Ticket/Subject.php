<?php

namespace App\QueryFilters\Ticket;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Subject
{
    public function __construct(
        protected Request $request
    )
    {
    }

    public function handle(Builder $builder, \Closure $next)
    {
        return $next($builder)
            ->when($this->request->has('subject'), function (Builder $builder) {
                $subject = '%' . $this->request->get('subject') . '%';

                return $builder->where('subject', 'like', $subject);
            });
    }
}
