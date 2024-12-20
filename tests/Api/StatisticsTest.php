<?php

use App\Models\User;
use App\Models\Ticket;

it('returns ticket statistics', function () {
    $user = User::factory()->create();
    Ticket::factory()->count(10)->for($user)->create(['status' => false]);
    Ticket::factory()->count(5)->for($user)->create(['status' => true]);

    $response = $this->getJson('/api/stats');

    $response->assertOk()
        ->assertJsonStructure([
            'total_tickets',
            'unprocessed_tickets',
            'top_user' => ['name', 'email', 'tickets_count'],
            'last_processed',
        ])
        ->assertJson([
            'total_tickets' => 15,
            'unprocessed_tickets' => 10,
            'top_user' => [
                'name' => $user->name,
                'email' => $user->email,
                'tickets_count' => 15,
            ],
        ]);
});
