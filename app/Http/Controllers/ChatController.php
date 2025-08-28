<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $channels = ['Whatsapp', 'Messenger', 'Telegram'];

        ##### MOCK MOCK MOCK MOCK #####
        $photo = '/images/contacts/default.png';
        $people = ['Bryan', 'Kaue', 'Lucas', 'Gustavo', 'Leticia', 'Valeria', 'Juliana', 'Bruno', 'Jefferson', 'Jonas','Bryan', 'Kaue', 'Lucas', 'Gustavo', 'Leticia', 'Valeria', 'Juliana', 'Bruno', 'Jefferson', 'Jonas'];

        $contacts = [];

        foreach ($people as $key => $person) {

            $data = [
                "id" => $key + 1,
                "photo" => $photo,
                "name" => $person,
                "last_message" => "Olá, tudo bem? Meu nome é {$person} Alves e estou aqui em contato.",
                "channel" => $channels[rand(0, 2)]
            ];

            if ($key % 2 === 0) {
                $data["unread_message"] = 4;
            }

            $contacts[] = $data;
        }
        ##### MOCK MOCK MOCK MOCK #####

        return Inertia::render('Index', [
            'contacts' => $contacts,
            'channels' => $channels
        ]);
    }
}
