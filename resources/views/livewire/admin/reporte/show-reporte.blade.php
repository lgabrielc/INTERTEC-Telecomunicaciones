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
                <x-jet-label class="" value="Title" />
                <x-jet-input type="text" class="block mt-1 w-full" wire:model.defer="state.title" />
                @error('title')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </x-slot>
        <x-slot name="footer">
        </x-slot>
    </x-jet-dialog-modal>
        


</div>
 