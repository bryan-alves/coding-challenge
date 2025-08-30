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
}
