<?php

namespace App\Events;

use App\Models\ParticipantChat;
use App\Models\Setting;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Pusher\Pusher;

class ChatPusherEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $content;
    public $user_id;
    public $chat_group_id;
    public $created_at;
    public $image_link;
    public $images;
    public $sender_id;
    public $pusher_id;

    public function __construct(Request $request, $id, $participant_chat, $sender_id, $image_link, $images)
    {
        $this->content = $request->contents;
        $this->user_id = $sender_id;
        $this->pusher_id = $participant_chat->user_id;
        //$this->sender_id = $sender_id;
        $this->chat_group_id = (int)$request->chat_group_id;
        $this->created_at = now();
        $this->image_link = $image_link;
        $this->images = $images;

        $participant_chats = ParticipantChat::where('chat_group_id', $participant_chat->chat_group_id)->get();

        foreach ($participant_chats as $item) {
            $item->touch();
        }

        $setting = Setting::first();

        $options = array(
            'cluster' => $setting->pusher_app_cluster ?? env('PUSHER_APP_CLUSTER'),
            'useTLS' => true
        );
        $pusher = new Pusher(
            $setting->pusher_app_key ?? env('PUSHER_APP_KEY'),
            $setting->pusher_app_secret ?? env('PUSHER_APP_SECRET'),
            $setting->pusher_app_id ?? env('PUSHER_APP_ID'),
            $options
        );

        $data = [
            'id' => $id,
            'content' => $request->contents,
            'user_id' => $sender_id,
            'pusher_id' => $participant_chat->user_id,
            'chat_group_id' => (int)$request->chat_group_id,
            'created_at' => now(),
            'image_link' => $image_link,
            'images' => $images,
        ];
        $pusher->trigger('id-chat-pusher-' . $this->pusher_id, 'id-chat-pusher-' . $this->pusher_id, $data);
    }

    public function broadcastOn()
    {
        //return ['id-chat-pusher-' . $this->pusher_id];
    }

    public function broadcastAs()
    {
        //return ('id-chat-pusher-' . $this->pusher_id);
    }
}
