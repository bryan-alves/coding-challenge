<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Contact;
use App\Models\Message;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $channels = Channel::pluck('name')->toArray();

        $contactsQuery = Contact::with(['channel', 'lastMessage'])
            ->withCount('unreadMessages');

        $selectedChannel = $request->query('channel', 'all');

        if ($selectedChannel !== 'all') {
            $channelId = Channel::where('name', $selectedChannel)->value('id');

            if ($channelId) {
                $contactsQuery->where('channel_id', $channelId);
            }
        }

        $contacts = $contactsQuery->get();

        return Inertia::render('Index', [
            'contacts' => $contacts,
            'channels' => $channels,
            'selectedChannel' => $selectedChannel,
        ]);
    }

    public function readMessage(Request $request)
    {
        Message::where('contact_id', $request->contact_id)
            ->where('is_read', false)
            ->update(['is_read' => true]);
    }
}
