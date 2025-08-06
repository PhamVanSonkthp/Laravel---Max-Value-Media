<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\ParticipantAddRequest;
use App\Models\Chat;
use App\Models\ChatGroup;
use App\Models\ParticipantChat;
use App\Models\RestfulAPI;
use App\Models\UserDocument;
use Illuminate\Http\Request;

class ParticipantChatController extends Controller
{

    private $model;

    public function __construct(Chat $model)
    {
        $this->model = $model;
    }

    public function list(Request $request)
    {
        $participantModel = new ParticipantChat();
        $queries = ['user_id' => auth()->id()];
        $results = RestfulAPI::response($participantModel, $request, $queries);
        return response()->json($results);
    }

    public function get(Request $request, $chatGroupId)
    {

        $item = ParticipantChat::where('user_id', auth()->id())->where('chat_group_id', $chatGroupId)->first();

        if (empty($item)) {
            return response()->json([
                "code" => 404,
                "message" => "Không tìm thấy nhóm chat"
            ], 404);
        }

        $queries = ["chat_group_id" => $item->chatGroup->id];

        $resultsMessage = RestfulAPI::response(new Chat(), $request, $queries);


        $item->messages = $resultsMessage;

        return $item;
    }

    public function create(ParticipantAddRequest $request)
    {
        $chatGoupsOfGetter = ParticipantChat::where('user_id', $request->getter_id)->get();
        $chatGoupsOfSender = ParticipantChat::where('user_id', auth()->id())->get();

        foreach ($chatGoupsOfGetter as $itemGetter) {
            foreach ($chatGoupsOfSender as $itemSender) {
                if ($itemSender->chat_group_id == $itemGetter->chat_group_id) {
                    $chatGoup = ChatGroup::find($itemSender->chat_group_id);
                    ParticipantChat::firstOrCreate(
                        [
                            'user_id' => auth()->id(),
                            'chat_group_id' => $chatGoup->id,
                        ]
                    );

                    ParticipantChat::firstOrCreate(
                        [
                            'user_id' => $request->getter_id,
                            'chat_group_id' => $chatGoup->id,
                        ]
                    );

                    return response()->json($chatGoup);
                }
            }
        }

        $chatGoup = ChatGroup::create([
            'title' => $request->title
        ]);

        ParticipantChat::create(
            [
                'user_id' => auth()->id(),
                'chat_group_id' => $chatGoup->id,
            ]
        );

        ParticipantChat::create(
            [
                'user_id' => $request->getter_id,
                'chat_group_id' => $chatGoup->id,
            ]
        );

        return response()->json($chatGoup);
    }
}
