<?php

use App\Mail\UnprocessedTicketsSummary;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;

it('sends daily unprocessed ticket summary emails', function () {
    $user = User::factory()->create();
    $tickets = Ticket::factory()->count(3)->create([
        'user_id' => $user->id,
        'status' => false,
    ]);

    Mail::fake();
    Artisan::call('app:send-daily-summary');

    Mail::assertSent(UnprocessedTicketsSummary::class, function ($mail) use ($user, $tickets) {
        return $mail->hasTo($user->email) && $mail->tickets->count() === $tickets->count();
    });
});
