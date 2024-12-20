<?php

use App\Models\User;
use App\Models\Ticket;

it('returns paginated list of tickets for a specific user by email', function () {
    $user = User::factory()->create(['email' => 'test@example.com']);
    Ticket::factory()->count(4)->for($user)->create();

    $response = $this->getJson('/api/users/test@example.com/tickets');

    $response->assertOk()
        ->assertJsonStructure([
            'data' => [['id', 'subject', 'content', 'status']],
            'meta',
            'links',
        ])
        ->assertJsonFragment(['id' => $user->tickets->first()->id]);
});

it('returns error when user not found by email', function () {
    $response = $this->getJson('/api/users/nonexistent@example.com/tickets');

    $response->assertNotFound()
        ->assertJson([
            'message' => 'User not found'
        ]);
});

