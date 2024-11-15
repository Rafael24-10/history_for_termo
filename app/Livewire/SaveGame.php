<?php

namespace App\Livewire;

use Exception;
use App\Models\Game;
use Illuminate\Database\Eloquent\Casts\Json;
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
    public array $disabledProps = [];
    public string $wordOfTheDay;
    public array $duetoWordsOfTheDay;
    public array $quartetoWordsOfTheDay;
    public string $input1;
    public string $input2;
    public string $input3;
    public string $input4;

    protected $messages = [
        'input1.required' => 'Campo obrigatório',
        'input1.min' => 'A palavra deve ter pelo menos 5 letras',
        'input1.max' => 'A palavra deve ter no máximo 5 letras',

        'input2.required' => 'Campo obrigatório',
        'input2.min' => 'A palavra deve ter pelo menos 5 letras',
        'input2.max' => 'A palavra deve ter no máximo 5 letras',

        'input3.required' => 'Campo obrigatório',
        'input3.min' => 'A palavra deve ter pelo menos 5 letras',
        'input3.max' => 'A palavra deve ter no máximo 5 letras',

        'input4.required' => 'Campo obrigatório',
        'input4.min' => 'A palavra deve ter pelo menos 5 letras',
        'input4.max' => 'A palavra deve ter no máximo 5 letras',

        'dailyGame.required' => 'Campo obrigatório'

    ];



    public $dailyGame = '';

    public function mount(): void
    {
        $this->userId = Auth::user()->id;
        $this->fetchGamesPlayedToday();
    }



    public function setWordsOfTheDay()
    {
        if ($this->type == 'termo') {
            $this->wordOfTheDay = $this->input1;
        } elseif ($this->type == 'dueto') {

            $this->duetoWordsOfTheDay[] = $this->input1;
            $this->duetoWordsOfTheDay[] = $this->input2;
        } elseif ($this->type == 'quarteto') {
            $this->quartetoWordsOfTheDay[] = $this->input1;
            $this->quartetoWordsOfTheDay[] = $this->input2;
            $this->quartetoWordsOfTheDay[] = $this->input3;
            $this->quartetoWordsOfTheDay[] = $this->input4;
        }
    }

    public function parseWordsToJson(array $words)
    {
        return json_encode($words);
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
        $rules = [
            'dailyGame' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (!Str::contains($value, 'term')) {
                        $fail('Clique em compartilhar no termo e cole o resultado sem modificações');
                    }
                }

            ],
        ];

        if ($this->type === 'termo') {
            $rules['input1'] = 'required|min:5|max:5';
        } elseif ($this->type === 'dueto') {
            $rules['input1'] = 'required|min:5|max:5';
            $rules['input2'] = 'required|min:5|max:5';
        } elseif ($this->type === 'quarteto') {
            $rules['input1'] = 'required|min:5|max:5';
            $rules['input2'] = 'required|min:5|max:5';
            $rules['input3'] = 'required|min:5|max:5';
            $rules['input4'] = 'required|min:5|max:5';
        }

        return $rules;
    }

    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName);
    // }

    private function setGameId(): void
    {
        if ($this->type == 'termo' && !Str::contains($this->dailyGame, 'X') && Str::contains($this->dailyGame, '*')) {

            $this->gameId = rtrim(Str::between($this->dailyGame, '#', '*'));
        } elseif ($this->type == 'termo' && !Str::contains($this->dailyGame, 'X') && !Str::contains($this->dailyGame, '*')) {

            $this->gameId = rtrim(Str::between($this->dailyGame, '#', '/'));
            $this->gameId = rtrim(substr($this->gameId, 0, strlen($this->gameId) - 1));
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

        if (Str::contains($this->dailyGame, '*')) {

            $this->attempts = rtrim(Str::between($this->dailyGame, '*', '🔥'));
        } else {
            $this->attempts = rtrim(Str::between($this->dailyGame, '#', '🔥'));
            $this->attempts = substr($this->attempts, -3);
        }
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
        }
    }


    private function save(): void
    {
        $this->saveGamesPlayedToday();
        $game = new Game();

        $game->gameId = $this->gameId;
        $game->user_id = $this->userId;
        $game->daily_game = $this->dailyGame;
        $game->type = $this->type;

        if ($this->attempts != null) {

            $game->attempts = $this->attempts;
        }

        $this->setWordsOfTheDay();

        if ($this->type == 'termo') {
            $game->words = $this->wordOfTheDay;
        }

        if($this->type == 'dueto'){
            $game->words = $this->parseWordsToJson($this->duetoWordsOfTheDay);
        }

        if($this->type == 'quarteto'){
            $game->words = $this->parseWordsToJson($this->quartetoWordsOfTheDay);
        }

        $game->chart = $this->gameChart;

        $game->save();
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


    public function render()
    {
        return view('livewire.save-game');
    }
}
