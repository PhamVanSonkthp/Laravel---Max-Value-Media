<?php

namespace App\Http\Controllers\API;

use App\Events\ChatPusherEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\PusherChatRequest;
use App\Models\Chat;
use App\Models\Helper;
use App\Models\ParticipantChat;

class ChatController extends Controller
{

    private $model;

    public function __construct(Chat $model)
    {
        $this->model = $model;
    }

    public function create(PusherChatRequest $request)
    {
        $request->validate([
            'contents' => 'required',
            'chat_group_id' => 'required',
            'images' => 'nullable',
            'images.*' => 'nullable|mimes:jpg,jpeg,png',
        ]);

        $chatModel = new Chat();

        $chat = $chatModel->create([
            'content' => $request->contents,
            'user_id' => auth()->id(),
            'chat_group_id' => (int)$request->chat_group_id,
        ]);

        if (is_array($request->images)) {
            foreach ($request->images as $image) {
                $item = Image::create([
                    'uuid' => Helper::getUUID(),
                    'table' => $chatModel->getTableName(),
                    'image_path' => "waiting",
                    'image_name' => "waiting",
                    'relate_id' => $chat->id,
                ]);


                $dataUploadFeatureImage = StorageImageTrait::storageTraitUpload($request, $image, 'product_comments', $item->id);

                $dataUpdate = [
                    'image_path' => $dataUploadFeatureImage['file_path'],
                    'image_name' => $dataUploadFeatureImage['file_name'],
                ];

                $item->update($dataUpdate);
            }
        }

        $chat->refresh();

        foreach (ParticipantChat::where('chat_group_id', $request->chat_group_id)->get() as $item) {
            $item->touch();
//            if (auth()->id() != $item->user_id) {
            event(new ChatPusherEvent($request, $chat->id, $item, auth()->id(), auth()->user()->avatar(), $chat->images));

//            }
            if (auth()->id() != $item->user_id) {
                Helper::sendNotificationToTopic($item->user_id, "Chat", $request->contents, false, null, null, "chat/" . $request->chat_group_id);
            }


            if ($item->user_id == auth()->id()) {
                $item->update([
                    'is_read' => 1,
                    'latest_touch' => now(),
                ]);
            } else {
                $item->update([
                    'is_read' => 0,
                    'latest_touch' => now(),
                ]);
            }
        }

        return response()->json($chat);
    }
}
