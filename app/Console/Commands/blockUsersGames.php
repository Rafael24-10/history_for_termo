<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class blockUsersGames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:block-games';

   
    protected $description = 'Block all games for the day';

   
    public function handle()
    {
        User::query()->update([
            'termo' => 1,
            'dueto' => 1,
            'quarteto' => 1
        ]);

        $this->info('campos atualizados com sucesso!');
        return 0;
    }
}
