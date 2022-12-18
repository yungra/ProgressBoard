<?php

namespace App\Events;

use App\Http\Resources\ChatResource;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatMessageCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $chat_message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ChatMessage $chat_message)
    {
        $this->chat_message = $chat_message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat-message');
    }

    public function broadcastWith()
    {
        return [
            'chat_message' => new ChatResource($this->chat_message),
        ];
    }
}
