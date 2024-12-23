<?php

use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use App\QueryFilters\Ticket\Subject;

it('filters tickets by subject', function () {
    Ticket::factory()->createMany([
        ['subject' => 'Support Request'],
        ['subject' => 'Billing Issue'],
        ['subject' => 'General Inquiry'],
    ]);

    $request = new TicketRequest(['subject' => 'Support']);
    $filter = new Subject($request);
    $builder = Ticket::query();

    $result = $filter->handle($builder, fn($query) => $query)->get();

    expect($result->count())->toBe(1)
        ->and($result->first()->subject)->toBe('Support Request');
});

it('returns all tickets when no subject filter is provided', function () {
    Ticket::factory()->createMany([
        ['subject' => 'Support Request'],
        ['subject' => 'Billing Issue'],
        ['subject' => 'General Inquiry'],
    ]);

    $request = new TicketRequest();
    $filter = new Subject($request);
    $builder = Ticket::query();

    $result = $filter->handle($builder, fn($query) => $query)->get();

    expect($result->count())->toBe(3);
});
