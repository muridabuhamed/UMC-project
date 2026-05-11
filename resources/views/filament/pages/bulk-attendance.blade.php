<x-filament-panels::page>
    <form wire:submit="save">
        {{ $this->form }}

    <div style="margin-top: 100px; display: flex; justify-content: center; padding-bottom: 50px;">
        <div style="width: 350px;">
            {{ $this->saveAction }}
        </div>
    </div>
    </form>
</x-filament-panels::page>
