<?php

namespace App\Livewire;

use Exception;
use App\Models\Game;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class SaveGame extends Component
{
    public $userId;
    public string $type = 'termo';
    private string $gameId = '';
    private string $attempts = '';
    private string $gameChart;
    private string $typeString;
    public string $errorMessage = '';
    // public bool $formDisabled = false;
    public array $disabledProps = [];


    public $dailyGame = '';

    public function mount(): void
    {
        $this->userId = Auth::user()->id;
        $this->fetchGamesPlayedToday();
    }

    private function fetchGamesPlayedToday()
    {
        $user = Auth::user();
        if ($user->termo) {
            $this->disabledProps[] = 'termo';
        }

        if ($user->dueto) {
            $this->disabledProps[] = 'dueto';
        }

        if ($user->quarteto) {
            $this->disabledProps[] = 'quarteto';
        }
    }

    public function rules()
    {
        return [
            'dailyGame' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (!Str::contains($value, 'term')) {
                        $fail('Clique em compartilhar no termo e cole o resultado sem modificações');
                    }
                }

            ]
        ];
    }

    private function setGameId(): void
    {
        if ($this->type == 'termo' && !Str::contains($this->dailyGame, 'X')) {

            $this->gameId = rtrim(Str::between($this->dailyGame, '#', '*'));
        } elseif (Str::contains($this->dailyGame, 'X')) {

            $this->gameId = rtrim(Str::between($this->dailyGame, '#', 'X'));
        } elseif ($this->type == 'dueto' && Str::contains($this->dailyGame, '🟥') || $this->type == 'quarteto' && Str::contains($this->dailyGame, '🟥')) {

            $this->gameId = rtrim(Str::between($this->dailyGame, '#', '\n'));
            $position = strpos($this->gameId, "\n");
            $result = substr($this->gameId, 0, $position);
            $this->gameId = $result;
        }
    }

    private function setAttemptsString(): void
    {
        $this->attempts = rtrim(Str::between($this->dailyGame, '*', '🔥'));
    }

    private function setGameChart(): void
    {
        if (Str::contains($this->dailyGame, '🔥')) {

            $this->gameChart = trim(Str::after($this->dailyGame, '🔥'));
            $this->gameChart = Str::substr($this->gameChart, 3, strlen($this->gameChart) - 1);
        } elseif (Str::contains($this->dailyGame, '🟥')) {

            $this->gameChart = trim(Str::after($this->dailyGame, $this->gameId));
            $result = Str::after($this->dailyGame, $this->gameId);
            $this->gameChart = $result;
        }
    }

    private function setGameTypeFromString(): void
    {
        $this->typeString = Str::between($this->dailyGame, 't', '#');
        $this->typeString = trim($this->typeString);
    }

    private function assertGameTypeIsValid(): bool
    {
        try {
            switch ($this->typeString) {
                case $this->typeString == 'erm.ooo' && $this->type == 'termo':
                    return true;


                case $this->typeString == 'erm.ooo/2' && $this->type == 'dueto';
                    return true;


                case $this->typeString == 'erm.ooo/4' && $this->type == 'quarteto';
                    return true;

                default:
                    throw new Exception('Insira um resultado que corresponda ao tipo de jogo selecionado');
            }
        } catch (Exception $e) {
            $this->errorMessage = $e->getMessage();
            return false;
        }
    }

    private function verifyStringIntegrity(): bool
    {
        try {

            if ($this->typeString != 'erm.ooo' && $this->typeString != 'erm.ooo/2' && $this->typeString != 'erm.ooo/4') {
                throw new Exception('Clique em compartilhar no termo e cole o resultado sem modificações');
            } else {
                return true;
            }
        } catch (Exception $e) {
            $this->errorMessage = $e->getMessage();
            return false;
        }
    }

    public function processString(): void
    {

        $this->errorMessage = '';

        $this->validate();
        $this->setGameTypeFromString();
        $this->setGameId();

        if ($this->type == 'termo') {

            $this->setAttemptsString();
        }
        $this->setGameChart();
        if ($this->assertGameTypeIsValid() && $this->verifyStringIntegrity()) {
            $this->save();
            $this->reset('dailyGame', 'gameChart');
            $this->redirect(route('dashboard'));
            // $this->formDisabled = true;
        }
    }

    private function saveGamesPlayedToday()
    {
        $user = Auth::user();
        switch ($this->type) {
            case 'termo':
                $user->termo = 1;
                break;
            case 'dueto':
                $user->dueto = 1;
                break;
            case 'quarteto':
                $user->quarteto = 1;
                break;
        }

        $user->save();
    }

    private function save(): void
    {
        $this->saveGamesPlayedToday();
        $game = new Game();

        $game->gameId = $this->gameId;
        $game->user_id = $this->userId;
        $game->daily_game = $this->dailyGame;
        if ($this->attempts != null) {

            $game->attempts = $this->attempts;
        }
        $game->chart = $this->gameChart;

        $game->save();
    }



    public function render()
    {
        return view('livewire.save-game');
    }
}
