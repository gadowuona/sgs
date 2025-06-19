<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-xl font-bold mb-4">Timeline</h2>

    <div class="divide-y divide-gray-200">
        @foreach ($timelineGroups as $stage => $events)
            <div class="py-4">
                <h3 class="font-semibold text-gray-700 mb-2">{{ ucfirst($stage) }}</h3>
                <ul class="space-y-1 text-sm text-gray-600">
                    @foreach ($events as $event)
                        <li class="flex justify-between">
                            <span>{{ $event->event }}</span>
                            {{-- <span class="text-gray-500">{{ $event->event_date->format('d M Y') }}</span> --}}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>
