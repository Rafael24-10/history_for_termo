<?php

namespace App\Livewire;

use App\Models\Game;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class GameHistory extends Component
{


    public $games;

    public function mount()
    {
        $this->fetchGameData();
    }

    public function fetchGameData()
    {

        $this->games = Game::where('user_id', Auth::user()->id)->get();
        // dd($this->games);
    }



    public function render()
    {
        return view('livewire.game-history');
    }
}
