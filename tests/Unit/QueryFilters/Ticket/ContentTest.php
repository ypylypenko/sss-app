<?php

use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use App\QueryFilters\Ticket\Content;

it('filters tickets by content', function () {
    Ticket::factory()->createMany([
        ['content' => 'Support Request'],
        ['content' => 'Billing Issue'],
        ['content' => 'General Inquiry'],
    ]);

    $request = new TicketRequest(['content' => 'Support']);
    $filter = new Content($request);
    $builder = Ticket::query();

    $result = $filter->handle($builder, fn($query) => $query)->get();

    expect($result->count())->toBe(1)
        ->and($result->first()->content)->toBe('Support Request');
});

it('returns all tickets when no content filter is provided', function () {
    Ticket::factory()->createMany([
        ['content' => 'Support Request'],
        ['content' => 'Billing Issue'],
        ['content' => 'General Inquiry'],
    ]);

    $request = new TicketRequest();
    $filter = new Content($request);
    $builder = Ticket::query();

    $result = $filter->handle($builder, fn($query) => $query)->get();

    expect($result->count())->toBe(3);
});
