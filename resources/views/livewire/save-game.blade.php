<form wire:submit.prevent="processString">

    <div class="py-5 flex flex-col gap-5">
        <p>Selecione o modo de jogo:</p>
        <select name="type" wire:model.live="type" class="bg-gray-600">
            <option value="termo" @if ($formDisabled && $submittedType == 'termo') disabled @endif>Termo</option>
            <option value="dueto" @if ($formDisabled && $submittedType == 'dueto') disabled @endif>Dueto</option>
            <option value="quarteto" @if ($formDisabled && $submittedType == 'quarteto') disabled @endif>Quarteto</option>
        </select>
        <p>Cole o resultado do seu jogo abaixo: </p>
        <div>
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
        <textarea wire:model="dailyGame" @if ($formDisabled && in_array($type, $disabledProps)) disabled @endif class="rounded-lg p-5  text-black"
            name="daily-game" cols="30" rows="10"></textarea>

    </div>
    <div class="flex gap-5">
        <button class="bg-blue-700 w-24 h-12 rounded-lg hover:bg-blue-800 transition-all"
        @if ($formDisabled && in_array($type, $disabledProps)) disabled @endif type="submit">Save</button>
        <button class="bg-yellow-600 w-24 h-12 rounded-lg hover:bg-yellow-700 transition-all"
        @if ($formDisabled && in_array($type, $disabledProps)) disabled @endif type="reset">Clear</button>
    </div>
</form>
