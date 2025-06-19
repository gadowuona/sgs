<div class="bg-white rounded-lg shadow p-4">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-bold">Progress so far</h2>
        <a href="#" class="text-blue-500 text-sm hover:underline">Show history</a>
    </div>

    <ol class="relative border-l border-gray-300 ml-4">
        @foreach ($milestones as $milestone)
            <li class="mb-6 ml-4">
                <div class="flex items-center">
                    <div
                        class="w-3 h-3 rounded-full {{ $milestone['completed'] ? 'bg-teal-600' : 'border border-teal-600 bg-white' }}">
                    </div>
                    <span class="ml-2 text-sm {{ $milestone['completed'] ? 'text-gray-800' : 'text-gray-400' }}">
                        {{ $milestone['label'] }}
                    </span>
                </div>
            </li>
        @endforeach
    </ol>
</div>
