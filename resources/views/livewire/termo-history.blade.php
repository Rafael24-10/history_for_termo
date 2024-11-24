<div>
    <div class="container mx-auto">

        <div class="py-10 space-y-4 flex items-start">
            <form class="flex justify-between md:space-x-5 sm:space-x-0 ">
                <x-text-input wire:model.live.debounce.250ms="search" placeholder="Procure uma palavra" />
                <x-primary-button type="reset">Limpar</x-primary-button>
            </form>

        </div>

        <div class="overflow-x-auto sm:hidden md:block">
            <table
                class="min-w-full bg-white border border-gray-300 shadow-lg rounded-lg dark:bg-gray-800 dark:border-gray-700">
                <thead>
                    <tr
                        class="bg-gray-100 text-gray-800 uppercase text-sm leading-normal dark:bg-gray-700 dark:text-gray-300">
                        <th class="py-4 px-6 text-center">Game Nº</th>
                        <th class="py-4 px-6 text-center">Palavra</th>
                        <th class="py-4 px-6 text-center">Tentativas</th>
                        <th class="py-4 px-6 text-center">Data</th>
                        <th class="{{ $isExpanded ? 'block' : 'hidden' }} py-4 px-6 text-center">
                            Gráfico</th>
                    </tr>
                </thead>
                @if ($this->filteredGames != null)
                    {{-- Search Results --}}
                    @foreach ($this->filteredGames as $game)
                        <tbody class="text-gray-700 text-sm font-medium dark:text-gray-300">
                            <tr wire:key="{{ $game->gameId }}" wire:click="toggle({{ $game->gameId }})"
                                class="border-b border-gray-300 dark:border-gray-600 hover:bg-gray-200 dark:hover:bg-indigo-600 duration-200 cursor-pointer {{ $expandedGameId == $game->gameId ? 'h-44 bg-indigo-600' : 'h-4' }}">
                                <td
                                    class="py-3 px-6 text-center {{ $expandedGameId == $game->gameId ? 'align-top' : 'align-center' }}">
                                    {{ $game->gameId }}</td>
                                <td
                                    class="py-3 px-6 text-center {{ $expandedGameId == $game->gameId ? 'align-top' : 'align-center' }}">
                                    {{ $game->words }}</td>
                                <td
                                    class="py-3 px-6 text-center {{ $expandedGameId == $game->gameId ? 'align-top' : 'align-center' }}">
                                    {{ $game->attempts }}</td>
                                <td
                                    class="py-3 px-6 text-center {{ $expandedGameId == $game->gameId ? 'align-top' : 'align-center' }}">
                                    {{ $game->created_at->format('d/m/Y H:i') }}</td>

                                <td
                                    class=" {{ $expandedGameId == $game->gameId ? 'block' : 'hidden' }} w-28  pt-5 mx-auto">


                                    {!! nl2br(e(trim($game->chart))) !!}


                                </td>

                            </tr>
                        </tbody>
                    @endforeach
                    {{-- End Search Results --}}
                @else
                    @foreach ($games as $game)
                        <tbody class="text-gray-700 text-sm font-medium dark:text-gray-300">
                            <tr wire:key="{{ $game->gameId }}" wire:click="toggle({{ $game->gameId }})"
                                class="border-b border-gray-300 dark:border-gray-600 hover:bg-gray-200 dark:hover:bg-indigo-600 duration-200 cursor-pointer {{ $expandedGameId == $game->gameId ? 'h-44 bg-indigo-600' : 'h-4' }}">
                                <td
                                    class="py-3 px-6 text-center {{ $expandedGameId == $game->gameId ? 'align-top' : 'align-center' }}">
                                    {{ $game->gameId }}</td>
                                <td
                                    class="py-3 px-6 text-center {{ $expandedGameId == $game->gameId ? 'align-top' : 'align-center' }}">
                                    {{ $game->words }}</td>
                                <td
                                    class="py-3 px-6 text-center {{ $expandedGameId == $game->gameId ? 'align-top' : 'align-center' }}">
                                    {{ $game->attempts }}</td>
                                <td
                                    class="py-3 px-6 text-center {{ $expandedGameId == $game->gameId ? 'align-top' : 'align-center' }}">
                                    {{ $game->created_at->format('d/m/Y H:i') }}</td>

                                <td
                                    class=" {{ $expandedGameId == $game->gameId ? 'block' : 'hidden' }} w-28  pt-5 mx-auto">


                                    {!! nl2br(e(trim($game->chart))) !!}


                                </td>

                            </tr>
                        </tbody>
                    @endforeach
                @endif
            </table>
        </div>

    </div>

    {{-- Mobile layout --}}
    <div class="sm:flex flex-col gap-5 md:hidden items-center justify-center w-full">
        @foreach ($games as $game)
            <div wire:click="toggle({{ $game->gameId }})"
                class="p-6 bg-gray-200 dark:bg-slate-800 w-10/12 space-y-1 rounded-xl {{ $expandedGameId == $game->gameId ? 'h-80 dark:bg-indigo-600' : 'h-44' }}"">
                <p class="text-xl font-extrabold capitalize text-center dark:text-white pb-2">{{ $game->words }}</p>
                <p class="dark:text-white">Game Nº: {{ $game->gameId }}</p>
                <p class="dark:text-white">Tentativas: {{ $game->attempts }}</p>
                <p class="dark:text-white">Data: {{ $game->created_at->format('d/m/Y H:i') }}</p>
                <p class=" {{ $expandedGameId == $game->gameId ? 'block' : 'hidden' }} w-28 h-40 pt-5 mx-auto">


                    {!! nl2br(e(trim($game->chart))) !!}


                </p>
            </div>
        @endforeach

    </div>

</div>
