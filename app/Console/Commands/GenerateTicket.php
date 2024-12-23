<?php

namespace App\Console\Commands;

use App\Models\Ticket;
use Illuminate\Console\Command;

class GenerateTicket extends Command
{
    protected $signature = 'app:generate-ticket';

    protected $description = 'Generate ticket command';

    public function handle(): void
    {
        Ticket::factory()->create();

        $this->info('Ticket created successfully!');
    }
}
