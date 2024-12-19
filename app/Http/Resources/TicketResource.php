<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $subject
 * @property string $content
 * @property bool $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class TicketResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'subject' => $this->subject,
            'content' => $this->content,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => $this->userResource(),
        ];
    }

    private function userResource(): UserResource
    {
        return UserResource::make($this->whenLoaded('user'));
    }
}
