<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Message;
use App\Models\Contact;

class GenerateMessages extends Command
{
    protected $signature = 'messages:generate {count=10} {--contact=}';
    protected $description = 'Generate messages for testing';

    public function handle()
    {
        $count = (int) $this->argument('count');
        $contactId = $this->option('contact');

        $this->info("Generating $count messages" . ($contactId ? " for contact $contactId" : " for random contacts") . "...");

        $contactIds = Contact::pluck('id')->toArray();

        for ($i = 0; $i < $count; $i++) {
            $randomContactId = $contactId ?? $contactIds[array_rand($contactIds)];

            Message::factory()->create([
                'contact_id' => $randomContactId,
            ]);
        }

        $this->info('Messages generated successfully!');
        return 0;
    }
}
