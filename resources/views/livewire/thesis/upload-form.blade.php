<div>

    <x-card title="Upload Your Thesis">
        <div class="space-y-6">

            <form wire:submit.prevent="submit" enctype="multipart/form-data" class="space-y-4">
                <div>
                    <x-input type="file" wire:model.live="file" accept=".pdf,.doc,.docx" />

                </div>

                <div wire:loading wire:target="file" class="text-sm text-gray-500">
                    Uploading file...
                </div>
                <div>
                    <x-button type="submit" green spinner="submit">
                        Submit
                    </x-button>
                </div>
            </form>
            @if (session()->has('message'))
                <div class="mt-4 text-green-600">{{ session('message') }}</div>
            @endif
            @if (session()->has('error'))
                <div class="mt-4 text-red-600">{{ session('error') }}</div>
            @endif
        </div>
    </x-card>
</div>
