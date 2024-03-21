<div>
    <form wire:submit="create">
        {{ $this->form }}
        <x-filament::button outlined class="mt-4 w-full" type="submit">
            <span wire:loading><x-filament::loading-indicator class="h-5 w-5 inline-block" /></span> Lakukan Penilaian
        </x-filament::button>
    </form>
</div>
