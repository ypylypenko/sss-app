<?php

use App\Models\Ticket;
use Illuminate\Support\Facades\Artisan;

it('processes the oldest unprocessed ticket', function () {
    $unprocessedTicket = Ticket::factory()->create(['status' => false]);
    $processedTicket = Ticket::factory()->create(['status' => true]);

    $exitCode = Artisan::call('app:process-ticket');

    $unprocessedTicket->refresh();
    expect($unprocessedTicket->status)->toBeTrue()
        ->and($exitCode)->toBe(0);

});
