<div>
    @if(auth()->user()->hasRole('super_admin'))
        @livewire('ai-command-center')
    @endif
</div>
