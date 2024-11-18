<?php

namespace App\Livewire;

use App\Models\Game;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class DuetoHistory extends Component
{
    public $isExpanded = false;
    public $expandedGameId = null;
    private $user;
    public $games;

    public function mount()
    {
        $this->fetchGames();
    }

    public function toggle2()
    {
        $this->isExpanded = !$this->isExpanded;
    }

    public function toggle($gameId)
    {

        $this->expandedGameId = $this->expandedGameId === $gameId ? null : $gameId;
        $this->toggle2();
    }

    public function fetchGames()
    {
        $this->user = Auth::user()->id;
        $this->games = Game::where('user_id', $this->user)->where('type', 'dueto')->get();
        foreach ($this->games as $game) {
            json_decode($game->words);
        }
    }


    public function render()
    {
        return view('livewire.dueto-history');
    }
}
