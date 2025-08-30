<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\Channel;

class ChannelsTableSeeder extends Seeder
{
    public function run(): void
    {
        $channels = ['whatsapp', 'telegram', 'messenger'];

        foreach ($channels as $name) {
            Channel::firstOrCreate([
                'name' => $name
            ]);
        }
    }
}
