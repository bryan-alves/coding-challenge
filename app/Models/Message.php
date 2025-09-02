<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_id',
        'user_id',
        'message',
        'is_read',
        'origin'
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function markAsRead($contactId)
    {
        return self::where('contact_id', $contactId)
            ->where('is_read', false)
            ->update(['is_read' => true]);
    }

    public static function send($contactId, $message, $userId = 1)
    {
        return self::create([
            'user_id'    => $userId,
            'contact_id' => $contactId,
            'message'    => $message,
            'origin'     => 'sent',
            'is_read'    => false,
        ]);
    }

    public static function forContact($contactId, $perPage = 20)
    {
        return self::where('contact_id', $contactId)
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }
}
