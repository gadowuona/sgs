<x-card title="Upload Your Thesis">
    <div class="space-y-6">
        @if (session()->has('message'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="submit" class="space-y-4">
            <div>
                <label for="file" class="block font-medium">Upload PDF File</label>
                <input type="file" wire:model="file" accept="application/pdf" class="w-full mt-1 border rounded p-2">
                @error('file')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div wire:loading wire:target="file" class="text-sm text-gray-500">
                Uploading file...
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Submit
            </button>
        </form>
    </div>
</x-card>
