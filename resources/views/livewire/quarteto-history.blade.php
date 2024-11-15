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
            <p class="dark:text-gray-400">Tentativas</p>
            <p class="dark:text-gray-400">Palavras</p>
        </div>

        <div>
            <p class="dark:text-gray-400">Data</p>
        </div>
    </div>

    <ul class=" ">
        <li wire:click="toggle"
            class=" flex justify-between hover:bg-indigo-600 transition-all cursor-pointer w-full px-16  {{ $isExpanded ? 'h-96 bg-indigo-600' : 'h-25' }} border-t  dark:border-gray-700 border-gray-300">
            <div class="flex justify-between w-3/12 items-center">
                <p class="dark:text-white">#900</p>
                <p class="dark:text-white">2/6</p>
                <div>
                    <p class="dark:text-white font-bold ">pular</p>
                    <p class="dark:text-white font-bold">cavar</p>
                    <p class="dark:text-white font-bold">bolsa</p>
                    <p class="dark:text-white font-bold">louça</p>
                </div>
            </div>

            <p class="dark:text-white flex items-center {{ $isExpanded ? 'hidden' : 'block' }}">Gráficos</p>
            <div class="{{ $isExpanded ? 'block' : 'hidden' }} flex items-center justify-center">


                <pre>
                    

                    

                    6️⃣🟥
                    8️⃣9️⃣
                    
                    


                </pre>


            </div>
            <p class="dark:text-white flex items-center">24/10/2024</p>

        </li>

        <hr class=" dark:border-gray-700 border-gray-300">
    </ul>

    <script></script>
</div>
