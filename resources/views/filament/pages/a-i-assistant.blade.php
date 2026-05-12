<x-filament-panels::page>
    <div style="max-width: 800px; margin: 0 auto; width: 100%; display: flex; flex-direction: column; height: 600px; background-color: white; border-radius: 12px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); overflow: hidden; border: 1px solid #e5e7eb;">
        <!-- Chat Header -->
        <div style="background-color: #4f46e5; padding: 16px; display: flex; align-items: center; gap: 12px;">
            <div style="background-color: rgba(255, 255, 255, 0.2); padding: 8px; border-radius: 8px; flex-shrink: 0;">
                <x-heroicon-o-sparkles style="width: 24px; height: 24px; color: white;" />
            </div>
            <div>
                <h3 style="color: white; font-weight: bold; margin: 0; font-size: 16px;">UMC AI Assistant</h3>
                <p style="color: #e0e7ff; font-size: 12px; margin: 0;">Powered by Gemini AI (Free)</p>
            </div>
        </div>

        <!-- Chat History -->
        <div style="flex: 1; overflow-y: auto; padding: 16px; background-color: #f9fafb; display: flex; flex-direction: column; gap: 16px;" id="chat-container">
            @if(empty($messages))
                <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%; text-align: center; gap: 12px; opacity: 0.6;">
                    <x-heroicon-o-chat-bubble-left-right style="width: 48px; height: 48px; color: #9ca3af;" />
                    <p style="font-size: 14px;">Hello! I'm your school's AI counselor. <br> Ask me about students, grades, or for help writing emails.</p>
                </div>
            @endif

            @foreach($messages as $message)
                <div style="display: flex; {{ $message['role'] === 'user' ? 'justify-content: flex-end' : 'justify-content: flex-start' }}">
                    <div style="max-width: 80%; padding: 12px; border-radius: 16px; font-size: 14px; {{ $message['role'] === 'user' ? 'background-color: #4f46e5; color: white; border-bottom-right-radius: 0;' : 'background-color: white; color: #1f2937; box-shadow: 0 1px 2px rgba(0,0,0,0.05); border: 1px solid #f3f4f6; border-bottom-left-radius: 0;' }}">
                        {!! nl2br(e($message['content'])) !!}
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Chat Input -->
        <div style="padding: 16px; background-color: white; border-top: 1px solid #e5e7eb;">
            <form wire:submit="ask" style="display: flex; gap: 8px;">
                <input 
                    type="text" 
                    wire:model="question" 
                    placeholder="Ask me something..." 
                    style="flex: 1; background-color: #f3f4f6; border: none; border-radius: 8px; padding: 8px 16px; font-size: 14px; outline: none;"
                    required
                >
                <button type="submit" wire:loading.attr="disabled" style="background-color: #4f46e5; color: white; padding: 8px 16px; border: none; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                    <span wire:loading.remove>
                        <x-heroicon-o-paper-airplane style="width: 20px; height: 20px;" />
                    </span>
                    <span wire:loading>
                        <svg style="animation: spin 1s linear infinite; width: 20px; height: 20px; color: white;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle style="opacity: 0.25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path style="opacity: 0.75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                </button>
            </form>
        </div>
    </div>

    <style>
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>

    <script>
        document.addEventListener('livewire:initialized', () => {
            const container = document.getElementById('chat-container');
            Livewire.on('messageAdded', () => {
                setTimeout(() => {
                    container.scrollTop = container.scrollHeight;
                }, 50);
            });
        });
    </script>
</x-filament-panels::page>
