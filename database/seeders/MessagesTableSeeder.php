<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;

class MessagesTableSeeder extends Seeder
{

    public function run($count = 5, $contactId = null): void
    {
        $factory = Message::factory($count);

        if ($contactId) {
            $factory->create([
                'contact_id' => $contactId,
            ]);
        } else {
            $factory->create();
        }
    }
}
