<?php

use App\Models\Ticket;
use App\QueryFilters\Ticket\Subject;
use Illuminate\Http\Request;

it('filters tickets by subject', function () {
    Ticket::factory()->createMany([
        ['subject' => 'Support Request'],
        ['subject' => 'Billing Issue'],
        ['subject' => 'General Inquiry'],
    ]);

    $request = new Request(['subject' => 'Support']);
    $filter = new Subject($request);
    $builder = Ticket::query();

    $result = $filter->handle($builder, fn ($query) => $query)->get();

    expect($result->count())->toBe(1)
        ->and($result->first()->subject)->toBe('Support Request');
});

it('returns all tickets when no subject filter is provided', function () {
    Ticket::factory()->createMany([
        ['subject' => 'Support Request'],
        ['subject' => 'Billing Issue'],
        ['subject' => 'General Inquiry'],
    ]);

    $request = new Request();
    $filter = new Subject($request);
    $builder = Ticket::query();

    $result = $filter->handle($builder, fn ($query) => $query)->get();

    expect($result->count())->toBe(3);
});
