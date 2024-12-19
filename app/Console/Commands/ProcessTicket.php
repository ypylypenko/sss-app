<?php

namespace App\Console\Commands;

use App\Models\Ticket;
use Illuminate\Console\Command;

class ProcessTicket extends Command
{
    protected $signature = 'app:process-ticket';

    protected $description = 'Command description';

    public function handle(): void
    {
        $ticket = Ticket::query()
            ->where('status', false)
            ->oldest()
            ->first();

        if ($ticket) {
            $ticket->update(['status' => true]);
            $this->info("Ticket ID {$ticket->id} processed.");
        } else {
            $this->info("No tickets to process.");
        }
    }
}
