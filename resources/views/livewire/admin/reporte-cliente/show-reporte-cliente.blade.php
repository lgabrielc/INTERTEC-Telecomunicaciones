<div>
    <x-jet-button wire:click="activarmodal" class="bg-blue-500 hover:bg-blue-700">
        Add New Item
    </x-jet-button>
    
    <x-jet-dialog-modal wire:model='vermodal'>
        <x-slot name="title">
            Agregar nuevo reporte
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4" for="inline-full-name">
                    Full Name
                </label>
                <x-jet-input type="text" class="block mt-1 w-full" wire:model.defer="state.title" />
                @error('title')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror

        </x-slot>
        <x-slot name="footer">

        </x-slot>
    </x-jet-dialog-modal>
        
</div>