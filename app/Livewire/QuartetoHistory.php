<?php

namespace App\Livewire;

use App\Models\Game;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class QuartetoHistory extends Component
{
    public $isExpanded = false;
    public $expandedGameId = null;
    private $user;
    public $games;
    public $search = '';

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
        $this->games = Game::where('user_id', $this->user)->where('type', 'quarteto')->get();
        foreach ($this->games as $game) {
            json_decode($game->words);
        }
    }

    public function getFilteredGamesProperty()
    {
        if ($this->search) {

            return $this->games->filter(
                function ($game) {

                    $wordsArray = json_decode($game->words, true);
                    if (is_array($wordsArray)) {
                        foreach ($wordsArray as $words) {
                            if (str_contains(strtolower($words), strtolower($this->search))) {
                                return true;
                            };
                        }
                    }
                    return false;
                }

            );
        };
    }



    public function render()
    {
        return view('livewire.quarteto-history');
    }
}
