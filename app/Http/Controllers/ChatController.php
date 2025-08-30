<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Contact;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $channels = Channel::pluck('name')->toArray();

        $contactsQuery = Contact::with(['channel', 'lastMessage'])
            ->withCount('unreadMessages');

        // filtrar pelo channel se não for "all"
        $selectedChannel = $request->query('channel', 'all');
        if ($selectedChannel !== 'all') {
            // pega o ID do canal pelo nome
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
}
