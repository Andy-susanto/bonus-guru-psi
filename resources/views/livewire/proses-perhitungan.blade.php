<div>
    <x-filament::button size="xs" icon="heroicon-s-calculator" wire:click='proses'>
        Proses Perhitungan
    </x-filament::button>
    <x-filament::section class="mt-4">
        <x-slot name="heading">
            Hasil Perhitungan
        </x-slot>
        {{$this->table}}
    </x-filament::section>
</div>
