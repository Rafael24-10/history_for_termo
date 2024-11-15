<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Game history
            </h2>
            <livewire:game-history />
        </div>
    </x-slot>

    <livewire:quarteto-history />
</x-app-layout>