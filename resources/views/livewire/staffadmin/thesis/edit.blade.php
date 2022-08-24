<div>
    <form wire:submit.prevent="save" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1  gap-5 ">

            <x-input label="Thesis/Dissertation Title" type="text" placeholder="Thesis/Dissertation title"
                wire:model.defer="title" />

            <x-input label="Submission Date" type="date" wire:model.defer="submission_date" />

            <x-input label="Due Date" type="date" wire:model.defer="due_date" />

        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button rose type="submit" spinner="save" :label="__('Submit')" />
        </div>
    </form>
</div>