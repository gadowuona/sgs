<form wire:submit.prevent="requestChanges">
    @csrf
    <div>
        <x-textarea label="Supervisor Note / Feedback" placeholder="" wire:model.defer="note" />
    </div>

    <div class="flex items-center justify-end mt-4 gap-2">
        <x-button rose type="submit" spinner="save" :label="__('Request Changes')" />
        <x-button wire:click.prevent="markAccepted" green>Accept</x-button>
    </div>
</form>
