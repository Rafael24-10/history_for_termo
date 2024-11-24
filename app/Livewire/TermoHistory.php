<?php

namespace App\Livewire;

use App\Models\Game;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class TermoHistory extends Component
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
        $this->games = Game::where('user_id', $this->user)->where('type', 'termo')->get();
    }

    public function getFilteredGamesProperty()
    {
        if ($this->search) {

            return $this->games->filter(
                function ($game) {

                    return str_contains(strtolower($game->words), strtolower($this->search));
                }

            );
        };
    }

    



    public function render()
    {
        return view('livewire.termo-history');
    }
}
