@if ($this->amendment)
    <div>
        <x-card title="Review Thesis">
            <div class="space-y-4">
                @if (session()->has('message'))
                    <div class="bg-green-100 text-green-700 px-4 py-2 rounded">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="flex flex-wrap gap-4">
                    <h3 class="font-bold">Latest Submission:</h3>
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
                        <x-input type="file" wire:model.defer="reviewFile" label="Optional Review File (PDF or DOCX)"
                            accept=".pdf,.docx" />
                    </div>

                    <div>
                        <x-textarea label="Supervisor Comments / Feedback" class="resize-y"
                            placeholder="Write your feedback here..." wire:model.defer="feedback" />

                    </div>

                    <div>
                        <x-button type="submit" green spinner="submit">
                            Submit Review
                        </x-button>
                    </div>
                </form>
            </div>
        </x-card>
    </div>
@endif
