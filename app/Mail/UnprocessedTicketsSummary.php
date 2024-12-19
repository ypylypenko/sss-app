<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class UnprocessedTicketsSummary extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        public Collection $tickets
    )
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Unprocessed Tickets Summary',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.unprocessed-tickets',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
