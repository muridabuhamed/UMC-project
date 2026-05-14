<div class="flex items-center gap-4">
    @if(auth()->user()->hasRole('super_admin'))

        <button 
            x-data 
            @click="$dispatch('open-modal', { id: 'ai-command-center-modal' }); $dispatch('openAICommandCenter')"
            class="p-2 text-gray-500 hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-500 transition-colors"
            title="AI Command Center"
        >
            <x-filament::icon
                icon="heroicon-o-sparkles"
                class="h-6 w-6"
            />
        </button>

        @livewire('ai-command-center')
    @endif
</div>
