<x-filament-widgets::widget>
    <x-filament::section>
        <form wire:submit.prevent="applyFilter">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <div class="col-span-3 grid grid-cols-1 md:grid-cols-3 gap-4">
                    {{ $this->form }}
                </div>

                <div class="flex justify-start md:justify-end gap-2 mt-3 md:mt-0">
                    <x-filament::button type="submit" color="primary" icon="heroicon-o-magnifying-glass">
                        Tampilkan
                    </x-filament::button>

                    <x-filament::button color="gray" icon="heroicon-o-arrow-path" wire:click="$dispatch('reset-filters')">
                        Reset
                    </x-filament::button>
                </div>
            </div>
        </form>
    </x-filament::section>
</x-filament-widgets::widget>
