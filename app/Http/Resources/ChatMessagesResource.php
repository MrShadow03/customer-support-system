<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatMessagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            "message" => $this->message,
            "userId" => $this->user->id,
            "userName" => $this->user->name,
            "ticketId" => $this->ticket->id,
            "ticketSubject" => $this->ticket->subject,
            "createdAt" => $this->created_at
        ];
    }
}
