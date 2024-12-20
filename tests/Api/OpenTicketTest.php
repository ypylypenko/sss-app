<?php

use App\Models\User;
use App\Models\Ticket;

it('returns paginated list of unprocessed tickets', function () {
    $user = User::factory()->create();
    Ticket::factory()->count(5)->for($user)->create(['status' => false]);

    $response = $this->getJson('/api/tickets/open');

    $response->assertOk()
        ->assertJsonStructure([
            'data' => [['id', 'subject', 'content', 'status', 'user' => ['name', 'email']]],
            'meta',
            'links',
        ])
        ->assertJsonFragment(['status' => false]);
});
