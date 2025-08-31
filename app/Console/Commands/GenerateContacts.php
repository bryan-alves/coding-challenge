<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateContacts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contacts:generate';

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
        $this->info('ContactsTableSeeder: Criando contatos...');
        $this->call('db:seed', ['--class' => 'ContactsTableSeeder']);
        $this->info('ContactsTableSeeder: Contatos criado com sucesso!');
        return 0;
    }
}
