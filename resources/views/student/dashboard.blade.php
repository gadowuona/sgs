<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 ">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <!--  -->
            @if (Session::has('message'))
                <x-alert-success>{{ Session::get('message') }}</x-alert-success>
            @endif
            @if (Session::has('error'))
                <x-alert-success>{{ Session::get('message') }}</x-alert-success>
            @endif

            <div class="grid gap-5">

                <livewire:thesis.details :thesis="$thesis" />

                <livewire:thesis.upload-form :thesis="$thesis" />

                <div>
                    <x-card class="space-y-4">
                        @foreach ($thesis->amendments as $amendment)
                            <div class="p-4 bg-gray-100 rounded w-full">
                                <p class="font-semibold">Version {{ $loop->iteration }} —
                                    {{ ucfirst($amendment->status) }}</p>
                                <p class="flex gap-2 flex-wrap">Student File:
                                    <a href="{{ Storage::url($amendment->file_path) }}"
                                        class="text-blue-600 underline">Download</a>
                                </p>
                                @if ($amendment->supervisor_file_path)
                                    <p>Supervisor File:
                                        <a href="{{ Storage::url($amendment->supervisor_file_path) }}"
                                            class="text-blue-600 underline">Download</a>
                                    </p>
                                @endif
                                @if ($amendment->supervisor_feedback)
                                    <p><strong>Feedback:</strong> {{ $amendment->supervisor_feedback }}</p>
                                @endif
                            </div>
                        @endforeach
                    </x-card>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
