<div 
    x-data="{ isOpen: false }" 
    x-on:open-modal.window="if ($event.detail.id === 'ai-command-center-modal') { isOpen = true; setTimeout(() => $refs.searchInput.focus(), 100); }"
    x-on:close-modal.window="if ($event.detail.id === 'ai-command-center-modal') isOpen = false"
>
    <template x-teleport="body">
        <div 
            x-show="isOpen" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 backdrop-blur-none"
            x-transition:enter-end="opacity-100 backdrop-blur-sm"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 backdrop-blur-sm"
            x-transition:leave-end="opacity-0 backdrop-blur-none"
            class="fixed inset-0 z-[999] flex items-center justify-center bg-slate-900/50 p-4 sm:p-6"
            style="display: none;"
        >
        <div 
            x-show="isOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            @click.away="isOpen = false"
            class="relative w-full max-w-3xl bg-white dark:bg-slate-900 rounded-3xl shadow-2xl ring-1 ring-slate-200 dark:ring-slate-800 overflow-hidden flex flex-col max-h-[90vh]"
        >
            <div class="flex items-center gap-4 p-6 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
                <div class="p-3 bg-gradient-to-br from-violet-600 to-amber-500 rounded-xl shadow-lg shadow-violet-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-black text-gray-900 dark:text-white tracking-tight m-0 leading-none">Command Intelligence</h2>
                    <p class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest m-0 mt-1">School Executive AI</p>
                </div>
                <button @click="isOpen = false" class="ml-auto text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            <div class="p-6 overflow-y-auto custom-scrollbar">
                <div class="relative flex items-center bg-white dark:bg-slate-800/50 border-2 border-slate-100 dark:border-slate-700 rounded-2xl p-1.5 transition-all duration-300 shadow-sm focus-within:border-violet-500 focus-within:ring-4 focus-within:ring-violet-500/10">
                    <input 
                        x-ref="searchInput"
                        type="text" 
                        wire:model="query"
                        wire:keydown.enter="ask"
                        placeholder="Ask anything about your school..." 
                        class="w-full px-4 py-3 bg-transparent border-none outline-none text-lg font-medium text-slate-800 dark:text-slate-200 placeholder-slate-400 focus:ring-0"
                    >
                    <div class="pr-2">
                        <button wire:click="ask" class="bg-gradient-to-r from-violet-600 to-amber-500 hover:from-violet-500 hover:to-amber-400 text-white border-none px-6 py-2.5 rounded-xl font-bold cursor-pointer transition-all duration-200 whitespace-nowrap shadow-md hover:-translate-y-0.5 hover:shadow-violet-500/40" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="ask">Analyze</span>
                            <span wire:loading wire:target="ask" class="flex items-center gap-2">
                                <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Thinking...
                            </span>
                        </button>
                    </div>
                </div>

                <div class="mt-8">
                    @if($isSearching)
                        <div class="text-center py-12">
                            <div class="relative w-16 h-16 mx-auto mb-4">
                                <div class="absolute inset-0 border-4 border-violet-100 dark:border-slate-700 rounded-full"></div>
                                <div class="absolute inset-0 border-4 border-transparent border-t-violet-600 border-r-amber-500 rounded-full animate-spin"></div>
                                <div class="absolute inset-4 bg-violet-600 rounded-full animate-pulse opacity-20"></div>
                            </div>
                            <p class="text-sm font-bold text-violet-600 dark:text-violet-400 uppercase tracking-widest animate-pulse">Synthesizing Data...</p>
                        </div>
                    @elseif($response)
                        <div class="bg-slate-50 dark:bg-slate-900/50 rounded-2xl p-6 border border-slate-200 dark:border-slate-800 shadow-inner mt-4">
                            <div class="prose prose-slate dark:prose-invert max-w-none text-[15px] leading-relaxed">
                                {!! \Illuminate\Support\Str::markdown($response) !!}
                            </div>
                        </div>
                    @else
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-wider text-slate-400 mb-3">Suggested Insights</p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <button wire:click="$set('query', 'Who are the top 3 students?'); ask()" class="flex items-center gap-3 w-full bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 p-4 rounded-2xl cursor-pointer transition-all duration-200 text-left hover:border-violet-500 hover:bg-violet-50 dark:hover:bg-slate-800/80 hover:-translate-y-0.5 hover:shadow-md">
                                    <div class="p-2 bg-violet-50 dark:bg-violet-500/10 rounded-xl text-violet-600 dark:text-violet-400">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" /><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /></svg>
                                    </div>
                                    <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">Top 3 Students</span>
                                </button>

                                <button wire:click="$set('query', 'Show me a revenue summary.'); ask()" class="flex items-center gap-3 w-full bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 p-4 rounded-2xl cursor-pointer transition-all duration-200 text-left hover:border-amber-500 hover:bg-amber-50 dark:hover:bg-slate-800/80 hover:-translate-y-0.5 hover:shadow-md">
                                    <div class="p-2 bg-emerald-50 dark:bg-emerald-500/10 rounded-xl text-emerald-600 dark:text-emerald-400">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    </div>
                                    <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">Revenue Pulse</span>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="p-4 border-t border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="px-2 py-1 bg-violet-100 dark:bg-violet-900/30 rounded-md text-[10px] font-black text-violet-600 dark:text-violet-400">PREMIUM v2.0</div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">AI Powered Command</span>
                </div>
                <button @click="isOpen = false" class="px-4 py-2 text-sm font-bold text-slate-600 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg shadow-sm hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                    Dismiss
                </button>
            </div>
        </div>
    </template>
</div>
