<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'subject' => 'string',
            'content' => 'string',
        ];
    }

    public function getSubjectParam(): ?string
    {
        return $this->get('subject');
    }

    public function getContentParam(): ?string
    {
        return $this->get('content');
    }

    public function getUserIdParam(): ?int
    {
        if (!$this->has('userId')) {
            return null;
        }

        return (int)$this->get('userId');
    }

    public function getStatusParam(): ?bool
    {
        $status = $this->get('status');
        if ($status === null) {
            return null;
        }

        return filter_var($status, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    }
}
