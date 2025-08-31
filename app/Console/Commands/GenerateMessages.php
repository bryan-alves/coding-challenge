<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'messages:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Roda o seeder MessagesTableSeeder';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('MessagesTableSeeder: Criando mensagens...');
        $this->call('db:seed', ['--class' => 'MessagesTableSeeder']);
        $this->info('MessagesTableSeeder: Mensagens criadas com sucesso!');
        return 0;
    }
}
