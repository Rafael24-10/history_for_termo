<form wire:submit="processString">

    <div class="py-5 flex flex-col gap-5">

        @if (count($disabledProps) == 3)
            <span class="info">
                <p>Você já jogou todos os jogos de hoje</p>
            </span>
        @else
            <p>Selecione o modo de jogo:</p>
            <select name="type" wire:model.live="type" class="bg-gray-600">
                <option value="termo" @if (in_array('termo', $disabledProps)) disabled @endif>Termo</option>
                <option value="dueto" @if (in_array('dueto', $disabledProps)) disabled @endif>Dueto</option>
                <option value="quarteto" @if (in_array('quarteto', $disabledProps)) disabled @endif>Quarteto</option>
            </select>

            @if ($type == 'termo')
                <input type="text" class="rounded-lg p-2 text-black" wire:model.live.debounce.300ms="input1"
                    placeholder="Digite a palavra do dia">

                @error('input1')
                    <span class="error">
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    </span>
                @enderror
            @elseif($type == 'dueto')
                <input type="text" class="rounded-lg p-2 text-black" wire:model.live.debounce.300ms="input1"
                    placeholder="Digite a primeira palavra">

                @error('input1')
                    <span class="error">
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    </span>
                @enderror

                <input type="text" class="rounded-lg p-2  text-black" wire:model.live.debounce.300ms="input2"
                    placeholder="Digite a segunda palavra">

                @error('input2')
                    <span class="error">
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    </span>
                @enderror
            @else
                <input type="text" class="rounded-lg p-2 text-black" wire:model.live.debounce.300ms="input1"
                    placeholder="Digite a primeira palavra">

                @error('input1')
                    <span class="error">
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    </span>
                @enderror

                <input type="text" class="rounded-lg p-2 text-black" wire:model.live.debounce.300ms="input2"
                    placeholder="Digite a segunda palavra">

                @error('input2')
                    <span class="error">
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    </span>
                @enderror

                <input type="text" class="rounded-lg p-2 text-black" wire:model.live.debounce.300ms="input3"
                    placeholder="Digite a terceira palavra">

                @error('input3')
                    <span class="error">
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    </span>
                @enderror

                <input type="text" class="rounded-lg p-2  text-black" wire:model.live.debounce.300ms="input4"
                    placeholder="Digite a quarta palavra">

                @error('input4')
                    <span class="error">
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    </span>
                @enderror
            @endif

            <p>Cole o resultado do seu jogo abaixo: </p>
            <textarea wire:model="dailyGame" @if (in_array($type, $disabledProps)) disabled @endif class="rounded-lg p-5  text-black"
                name="daily-game" cols="30" rows="10"></textarea>


    </div>
    <div class="my-4">
        @if ($errorMessage)
            <span class="error">
                <p class="text-sm text-red-600">{{ $errorMessage }}</p>
            </span>
        @endif
        @error('dailyGame')
            <span class="error">
                <p class="text-sm text-red-600">{{ $message }}</p>
            </span>
        @enderror
    </div>
    <div class="flex gap-5">
        <button class="bg-blue-700 w-24 h-12 rounded-lg hover:bg-blue-800 transition-all"
            @if (in_array($type, $disabledProps)) disabled @endif type="submit">Save</button>
        <button class="bg-yellow-600 w-24 h-12 rounded-lg hover:bg-yellow-700 transition-all"
            @if (in_array($type, $disabledProps)) disabled @endif type="reset">Clear</button>
    </div>
    @endif
</form>
