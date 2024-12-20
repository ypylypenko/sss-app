<?php

use App\Models\User;
use App\Models\Ticket;

it('returns paginated list of processed tickets', function () {
    $user = User::factory()->create();
    Ticket::factory()->count(3)->for($user)->create(['status' => true]);

    $response = $this->getJson('/api/tickets/closed');

    $response->assertOk()
        ->assertJsonStructure([
            'data' => [['id', 'subject', 'content', 'status', 'user' => ['name', 'email']]],
            'meta',
            'links',
        ])
        ->assertJsonFragment(['status' => true]);
});

