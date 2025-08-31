<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Contact;
use App\Models\Message;
use Exception;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $channels = Channel::pluck('name')->toArray();

        $contactsQuery = Contact::with(['channel', 'lastMessage'])
            ->withCount([
                'unreadMessages as unread_messages_count' => function ($query) {
                    $query->where('origin', 'received');
                }
            ]);

        $selectedChannel = $request->query('channel', 'all');

        if ($selectedChannel !== 'all') {
            $channelId = Channel::where('name', $selectedChannel)->value('id');

            if ($channelId) {
                $contactsQuery->where('channel_id', $channelId);
            }
        }

        $contacts = $contactsQuery->get();

        $messages = [];

        if ($request->contact_id) {
            $messages = Message::where('contact_id', $request->contact_id)
            ->orderBy('id', 'desc')
            ->paginate(20);
        }

        return Inertia::render('Index', [
            'contacts' => $contacts,
            'channels' => $channels,
            'selectedChannel' => $selectedChannel,
            'messages' => $messages
        ]);
    }

    public function readMessage(Request $request)
    {
        Message::where('contact_id', $request->contact_id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

            return $this->index($request);
    }

    public function sendMessage(Request $request)
    {
        Message::create([
            'user_id'    => 1,
            'contact_id' => $request->contact_id,
            'message'    => $request->content,
            'origin'     => 'sent',
            'is_read'    => false,
        ]);

        return $this->index($request);
    }
}
