<div>
    <div class="py-8 px-16 space-y-4">
        <h1 class="font-extrabold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Dueto
        </h1>

    </div>
    {{-- List header --}}
    <div class="flex  justify-between px-16">
        <div class="flex justify-between w-3/12">
            <p class="dark:text-gray-400">Game Nº</p>
            
            <p class="dark:text-gray-400">Palavras</p>
        </div>

        <div>
            <p class="dark:text-gray-400">Data</p>
        </div>
    </div>

    <ul class=" ">
        @foreach($games as $game)
        <li wire:click="toggle"
            class=" flex justify-between hover:bg-indigo-600 transition-all cursor-pointer w-full px-16  {{ $isExpanded ? 'h-96 bg-indigo-600' : 'h-12' }} border-t  dark:border-gray-700 border-gray-300">
            <div class="flex justify-between w-3/12 items-center">
                <p class="dark:text-white">{{$game->gameId}}</p>
                <div>
                    <p class="dark:text-white font-bold ">{{}}</p>
                    <p class="dark:text-white font-bold ">pousa</p>
                </div>
            </div>

            <p class="dark:text-white flex items-center {{ $isExpanded ? 'hidden' : 'block' }}">Gráficos</p>
            <div class="{{ $isExpanded ? 'block' : 'hidden' }} flex items-center justify-center">


                <pre>
                    

🟥7️⃣

⬛⬛⬛🟨🟨  ⬛⬛⬛🟩🟩
⬛🟨⬛⬛🟨  ⬛⬛⬛🟩🟩
⬛🟨⬛🟨🟨  ⬛🟩⬛🟩🟩
🟨🟨⬛🟨🟨  ⬛🟩⬛🟩🟩
⬛🟨⬛🟨🟨  ⬛🟩🟩🟩🟩
⬛🟨⬛🟨🟨  ⬛🟩🟩🟩🟩
⬛🟨⬛🟨🟨  🟩🟩🟩🟩🟩


                </pre>


            </div>
            <p class="dark:text-white flex items-center">24/10/2024</p>

        </li>

        <hr class=" dark:border-gray-700 border-gray-300">
        @endforeach
    </ul>

    <script></script>
</div>