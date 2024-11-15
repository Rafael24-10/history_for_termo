<!-- Primary Navigation Menu -->

<div class="flex">
    <!-- Navigation Links -->
    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <x-nav-link :href="route('game-history')" :active="request()->routeIs('game-history')" wire:navigate>
            {{ __('Termo') }}
        </x-nav-link>
        <x-nav-link :href="route('game-history-dueto')" :active="request()->routeIs('game-history-dueto')" wire:navigate>
            {{ __('Dueto') }}
        </x-nav-link>
        <x-nav-link :href="route('game-history-quarteto')" :active="request()->routeIs('game-history-quarteto')" wire:navigate>
            {{ __('Quarteto') }}
        </x-nav-link>
    </div>
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        
    </h2>
</div>

