<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;

class MessagesTableSeeder extends Seeder
{
    public function run(): void
    {
        // cria 50 mensagens
        Message::factory(50)->create();
    }
}