<div class="bg-white p-6 rounded shadow space-y-6">

    <h2 class="text-xl font-bold">Review Thesis</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded">
            {{ session('message') }}
        </div>
    @endif

    <div>
        <button wire:click.prevent="download" class="text-blue-600 underline">
            📄 Download Thesis
        </button>
    </div>

    <form wire:submit.prevent="submit" class="space-y-4">
        <div>
            <x-native-select label="Title" :options="[
                ['value' => '', 'name' => '-- Choose --'],
                ['value' => 'accepted', 'name' => '✅ Accepted'],
                ['value' => 'changes-requested', 'name' => '❌ Changes Requested'],
            ]" option-label="name" option-value="value"
                wire:model.defer="status" />
        </div>

        <div>
            <x-textarea label="Supervisor Comments / Feedback" class="resize-y"
                placeholder="Write your feedback here..." wire:model.defer="feedback" />

        </div>

        <div>
            <button type="submit" class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700">
                Submit Review
            </button>
        </div>
    </form>
</div>
