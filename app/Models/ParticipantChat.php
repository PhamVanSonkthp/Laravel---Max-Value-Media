<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ParticipantChat extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // begin

    public function adminCare()
    {
        return $this->hasOne(User::class, 'id', 'admin_care_id');
    }

    public function chatGroup()
    {
        return $this->belongsTo(ChatGroup::class);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function users()
    {
        $users = [];
        $participantChats = ParticipantChat::where('chat_group_id', $this->chat_group_id)->where('user_id', '!=', auth()->id())->get();
        foreach ($participantChats as $item) {
            if ($item && $item->user) {
                $item->user;
                optional($item->user)->role;
                $users[] = $item->user;
            }
        }

        return $users;
    }

    public static function chatGroupIdWithUser($user_id)
    {

        if (empty($user_id)) {
            return 0;
        }
        $participantChats = ParticipantChat::where('user_id', $user_id)->get();

        foreach ($participantChats as $item) {
            $participantChatAuther = ParticipantChat::where('user_id', auth()->id())->get();
            foreach ($participantChatAuther as $chatAuther) {
                if (!empty($chatAuther) && $chatAuther->chat_group_id == $item->chat_group_id) {
                    return $chatAuther->chat_group_id;
                }
            }
        }

        return 0;
    }

    public function status()
    {
        return $this->hasOne(ParticipantChatStatus::class, 'id', 'status');
    }

    public function latestMessage()
    {
        $item = Chat::where('chat_group_id', $this->chat_group_id)->latest()->first();
        return $item;
    }

    // end

    public function getTableName()
    {
        return Helper::getTableName($this);
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array['image_path_avatar'] = $this->avatar();
        $array['path_images'] = $this->images;
        $array['users']  = $this->users();
        $array['chat_group'] = $this->chatGroup;
        $array['latest_message'] = $this->latestMessage();

        return $array;
    }

    public function avatar($size = "100x100")
    {
        return Helper::getDefaultIcon($this, $size);
    }

    public function image()
    {
        return Helper::image($this);
    }

    public function images()
    {
        return Helper::images($this);
    }

    public function createdBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by_id');
    }

    public function searchByQuery($request, $queries = [], $randomRecord = null, $makeHiddens = null, $isCustom = false)
    {
        return Helper::searchByQuery($this, $request, $queries, $randomRecord, $makeHiddens, $isCustom);
    }

    public function storeByQuery($request)
    {
        $dataInsert = [
            'title' => $request->title,
            'content' => $request->contents,
            'slug' => Helper::addSlug($this, 'slug', $request->title),
        ];

        $item = Helper::storeByQuery($this, $request, $dataInsert);

        return $this->findById($item->id);
    }

    public function updateByQuery($request, $id)
    {
        $dataUpdate = [
            'title' => $request->title,
            'content' => $request->contents,
            'slug' => Helper::addSlug($this, 'slug', $request->title),
        ];
        $item = Helper::updateByQuery($this, $request, $id, $dataUpdate);
        return $this->findById($item->id);
    }

    public function deleteByQuery($request, $id, $forceDelete = false)
    {
        return Helper::deleteByQuery($this, $request, $id, $forceDelete);
    }

    public function deleteManyByIds($request, $forceDelete = false)
    {
        return Helper::deleteManyByIds($this, $request, $forceDelete);
    }

    public function findById($id)
    {
        $item = $this->find($id);
        return $item;
    }
}
