<div>
    <style>
        .ai-modal-container {
            font-family: 'Outfit', sans-serif;
            color: #1e293b;
        }
        .ai-header-gradient {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            padding: 12px;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3);
        }
        .ai-search-wrapper {
            position: relative;
            background: white;
            border: 2px solid #f1f5f9;
            border-radius: 16px;
            display: flex;
            align-items: center;
            padding: 4px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        .ai-search-wrapper:focus-within {
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }
        .ai-input {
            width: 100%;
            padding: 16px;
            border: none;
            outline: none;
            font-size: 18px;
            font-weight: 500;
            background: transparent;
        }
        .ai-analyze-btn {
            background: linear-gradient(to right, #4f46e5, #7c3aed);
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .ai-analyze-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4);
        }
        .ai-suggestion-card {
            background: white;
            border: 1px solid #f1f5f9;
            padding: 16px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: all 0.2s;
            text-align: left;
            width: 100%;
        }
        .ai-suggestion-card:hover {
            border-color: #6366f1;
            background: #f8faff;
            transform: translateY(-2px);
        }
        .ai-card-icon {
            padding: 8px;
            background: #eef2ff;
            border-radius: 10px;
            color: #4f46e5;
        }
        .ai-result-box {
            background: #f8fafc;
            border-radius: 20px;
            padding: 24px;
            border: 1px solid #e2e8f0;
            margin-top: 20px;
        }
        .ai-footer-tag {
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #94a3b8;
        }
    </style>

    <x-filament::modal
        id="ai-command-center-modal"
        width="3xl"
        display-classes="block"
        :close-by-clicking-away="true"
        wire:model="isOpen"
    >
        <x-slot name="heading">
            <div style="display: flex; align-items: center; gap: 16px;" class="ai-modal-container">
                <div class="ai-header-gradient">
                    <svg style="width: 24px; height: 24px; color: white;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                </div>
                <div>
                    <h2 style="font-size: 24px; font-weight: 900; margin: 0; letter-spacing: -0.5px;">Command Intelligence</h2>
                    <p style="font-size: 10px; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin: 0; letter-spacing: 2px;">School Executive AI</p>
                </div>
            </div>
        </x-slot>

        <div style="padding: 20px 0;" class="ai-modal-container">

        <div class="ai-search-wrapper">
                <input 
                    type="text" 
                    wire:model="query"
                    wire:keydown.enter="ask"
                    placeholder="Ask anything about your school..." 
                    class="ai-input"
                    autofocus
                >
                <div style="padding-right: 8px;">
                    <button wire:click="ask" class="ai-analyze-btn" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="ask">Analyze</span>
                        <span wire:loading wire:target="ask">Thinking...</span>
                    </button>
                </div>
            </div>

            <div style="margin-top: 32px;">
                @if($isSearching)
                    <div style="text-align: center; padding: 40px 0;">
                        <div style="width: 48px; height: 48px; border: 4px solid #eef2ff; border-top: 4px solid #6366f1; border-radius: 50%; margin: 0 auto 16px; animation: spin 1s linear infinite;"></div>
                        <p style="font-size: 14px; font-weight: 700; color: #6366f1; text-transform: uppercase; letter-spacing: 1px;">Synthesizing Data...</p>
                        <style>@keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }</style>
                    </div>
                @elseif($response)
                    <div class="ai-result-box">
                        <div style="font-size: 15px; line-height: 1.6; color: #334155;">
                            {!! \Illuminate\Support\Str::markdown($response) !!}
                        </div>
                    </div>
                @else
                    <div>
                        <p class="ai-footer-tag" style="margin-bottom: 12px;">Suggested Insights</p>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                            <button wire:click="$set('query', 'Who are the top 3 students?'); ask()" class="ai-suggestion-card">
                                <div class="ai-card-icon">
                                    <svg style="width: 20px; height: 20px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" /><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /></svg>
                                </div>
                                <span style="font-size: 14px; font-weight: 600;">Top 3 Students</span>
                            </button>

                            <button wire:click="$set('query', 'Show me a revenue summary.'); ask()" class="ai-suggestion-card">
                                <div class="ai-card-icon" style="color: #10b981; background: #ecfdf5;">
                                    <svg style="width: 20px; height: 20px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                                <span style="font-size: 14px; font-weight: 600;">Revenue Pulse</span>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <x-slot name="footer">
            <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <div style="padding: 4px 8px; background: #f1f5f9; border-radius: 6px; font-size: 10px; font-weight: 800; color: #64748b;">PREMIUM v1.2</div>
                    <span class="ai-footer-tag">Gemini Cloud Powered</span>
                </div>
                <x-filament::button color="gray" wire:click="close" variant="ghost" size="sm">
                    Dismiss
                </x-filament::button>
            </div>
        </x-slot>
    </x-filament::modal>
</div>
