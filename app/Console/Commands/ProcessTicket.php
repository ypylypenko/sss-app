<?php

namespace App\Console\Commands;

use App\Repositories\TicketRepository;
use Illuminate\Console\Command;

class ProcessTicket extends Command
{
    protected $signature = 'app:process-ticket';

    protected $description = 'Process ticket command';

    public function handle(TicketRepository $ticketRepository): void
    {
        $ticket = $ticketRepository->getOldestTicket();

        if ($ticket) {
            $ticketRepository->updateTicketStatus(
                ticket: $ticket,
                status: true
            );

            $this->info("Ticket ID {$ticket->id} processed.");
        } else {
            $this->info("No tickets to process.");
        }
    }
}
