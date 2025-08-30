<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ChannelsTableSeeder extends Seeder
{
    public function run(): void
    {
        $channels = ['whatsapp', 'telegram', 'messenger'];

        foreach ($channels as $name) {
            DB::table('channels')->insert([
                'name' => $name
            ]);
        }
    }
}
