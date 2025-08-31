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
        try {
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
        } catch(Exception $e) {
            \Log::error("Erro ao listar mensagens", [
                'exception' => $e->getMessage(),
                'request' => $request->all()
            ]);

            return back()->withErrors([
                'error' => 'Não foi possível listar as mensagens!'
            ]);
        }
    }

    public function readMessage(Request $request)
    {
        try {
            if (!$request->has('contact_id') || empty($request->contact_id)) {
                throw new \Exception("contact_id é obrigatório");
            }

            Message::where('contact_id', $request->contact_id)
                ->where('is_read', false)
                ->update(['is_read' => true]);

            return redirect()->back()->with([
                'success' => true,
            ]);
        } catch(Exception $e) {
            \Log::error("Erro ao ler mensagem", [
                'exception' => $e->getMessage(),
                'request' => $request->all()
            ]);

            return back()->withErrors([
                'error' => 'Não foi ler a mensagem deste contato, tente novamente!'
            ]);
        }
    }

    public function sendMessage(Request $request)
    {
        try {
            if (!$request->has('contact_id') || empty($request->contact_id)) {
                throw new \Exception("contact_id é obrigatório");
            }

            if (!$request->has('message') || empty($request->message)) {
                throw new \Exception("message é obrigatório");
            }

            if ($request->message === '123erro') {
                throw new \Exception('Erro simulado!');
            }

            Message::create([
                'user_id'    => 1,
                'contact_id' => $request->contact_id,
                'message'    => $request->message,
                'origin'     => 'sent',
                'is_read'    => false,
            ]);

            return redirect()->back()->with([
                'success' => true,
                'contact_id' => $request->contact_id,
            ]);
        } catch(Exception $e) {
            \Log::error("Erro ao enviar mensagem", [
                'exception' => $e->getMessage(),
                'request' => $request->all()
            ]);

            return back()->withErrors([
                'error' => 'Não foi possível enviar a mensagem, tente novamente!'
            ]);
        }
    }
}
