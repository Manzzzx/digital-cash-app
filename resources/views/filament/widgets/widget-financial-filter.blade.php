<x-filament::section>
    <form wire:submit.prevent="applyFilter">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            {{-- FILTER --}}
            <div class="col-span-3 grid grid-cols-1 md:grid-cols-3 gap-4">
                {{ $this->form }}
            </div>

            {{-- BUTTONS --}}
            <div class="flex gap-2 justify-start md:justify-end">
                <x-filament::button type="button" color="gray" icon="heroicon-o-arrow-path" wire:click="resetFilters">
                    Reset
                </x-filament::button>

                <x-filament::button type="submit" color="primary" icon="heroicon-o-magnifying-glass">
                    Tampilkan
                </x-filament::button>
            </div>
        </div>
    </form>
</x-filament::section>
