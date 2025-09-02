<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function lastMessage()
    {
        return $this->hasOne(Message::class)
                    ->latest('id');
    }

    public function unreadMessages()
    {
        return $this->hasMany(Message::class)
                    ->where('is_read', false);
    }

    public static function forChannel($channelName = null)
    {
        $query = self::with(['channel', 'lastMessage'])
            ->withCount(['unreadMessages as unread_messages_count' => function ($q) {
                $q->where('origin', 'received');
            }]);

        if ($channelName && $channelName !== 'all') {
            $channelId = Channel::where('name', $channelName)->value('id');
            if ($channelId) {
                $query->where('channel_id', $channelId);
            }
        }

        return $query->get();
    }

    public static function modalContacts($channelName)
    {
        $query = self::with('channel');

        $channelId = Channel::where('name', $channelName)->value('id');
        if ($channelId) {
            $query->where('channel_id', $channelId);
        }

        return $query->get();
    }
}
