<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Contact;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $channels = Channel::pluck('name')->toArray();

        $contacts = Contact::with(['channel', 'lastMessage'])
            ->withCount('unreadMessages')
            ->get();

        return Inertia::render('Index', [
            'contacts' => $contacts,
            'channels' => $channels
        ]);
    }
}
