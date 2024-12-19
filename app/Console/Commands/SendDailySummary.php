<?php

namespace App\Console\Commands;

use App\Mail\UnprocessedTicketsSummary;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDailySummary extends Command
{
    protected $signature = 'app:send-daily-summary';

    protected $description = 'Command description';

    public function handle(): void
    {
        User::query()
            ->with('tickets')
            ->chunk(100, function ($users) {
                foreach ($users as $user) {
                    $unprocessedTickets = $user->tickets()->where('status', false)->get();
                    if ($unprocessedTickets->isNotEmpty()) {
                        Mail::to($user)->send(new UnprocessedTicketsSummary($unprocessedTickets));
                    }
                }
            });
    }
}
