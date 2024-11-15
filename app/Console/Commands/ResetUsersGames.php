<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ResetUsersGames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:reset-fields';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset games played by user so they can add more games';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        User::query()->update([
            'termo' => 0,
            'dueto' => 0,
            'quarteto' => 0
        ]);

        $this->info('campos atualizados com sucesso!');
        return 0;
    }
}
