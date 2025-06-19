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

            <div class="grid gap-5">

                <x-card title="Thesis / Dissertation Detail">
                    <div class="grid grid-cols-3 gap-5 mt-4">
                        <div>
                            Thesis / Dissertation Title
                        </div>
                        <div class="col-span-2">
                            {{ ucwords($thesis->title) }}
                        </div>
                        <div class="col-span-3 border-b"></div>
                        <div>
                            Appointment Date
                        </div>
                        <div class="col-span-2">
                            {{ $thesis->appointment_date }}
                        </div>
                        <div class="col-span-3 border-b"></div>
                        <div>
                            Completed Status
                        </div>
                        <div class="col-span-2 capitalize">
                            {{ $thesis->complete_status }}
                        </div>
                        <div class="col-span-3 border-b"></div>
                        <div>
                            Payment Status
                        </div>
                        <div class="col-span-2 capitalize">
                            {{ $thesis->payment_status }}
                        </div>
                        <div class="col-span-3 border-b"></div>
                        <div>
                            Student
                        </div>
                        <div class="col-span-2">
                            <div class="flex">
                                {{-- <div class="mr-4">
                                            {{-- @if ($supervisor->picture)
                                                <x-avatar size="w-24 h-24"
                                                    src="{{ asset('assets/supervisor') }}/{{ $supervisor->picture }}" />
                                            @else
                                            <x-avatar size="w-24 h-24" src="https://picsum.photos/300?size=24x" />
                                            @endif
                                        </div> --}}
                                <div>
                                    <p>
                                        {{ $thesis->student->index_number }}
                                    </p>
                                    <p>
                                        {{ $thesis->student->full_name }}
                                    </p>
                                    <p>
                                        {{ $thesis->student->email }}
                                    </p>
                                    <p>
                                        {{ $thesis->student->programme }}
                                    </p>
                                    <p>
                                        {{ $thesis->student->phone1 }}
                                    </p>
                                    <p>
                                        {{ $thesis->student->phone2 }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-3 border-b"></div>
                    </div>

                    <div class="grid sm:grid-cols-2  gap-5 mt-4">
                        @foreach ($thesis->supervisors->reverse() as $supervisor)
                            <div class="my-4">
                                <x-card title="{{ $loop->index == 0 ? 'Supervisor' : 'Co Supervisor' }}">

                                    <div class="flex">
                                        <div class="mr-4">
                                            @if ($supervisor->picture)
                                                <x-avatar size="w-24 h-24"
                                                    src="{{ asset('assets/supervisor') }}/{{ $supervisor->picture }}" />
                                            @else
                                                <x-avatar size="w-24 h-24" src="https://picsum.photos/300?size=24x" />
                                            @endif
                                        </div>
                                        <div>
                                            <p>
                                                {{ $supervisor->title }}
                                                {{ $supervisor->user->name }}
                                            </p>
                                            <p>
                                                {{ $supervisor->user->email }}
                                            </p>
                                            <p>
                                                {{ $supervisor->phone1 }}
                                            </p>
                                            <p>
                                                {{ $supervisor->phone2 }}
                                            </p>
                                        </div>
                                    </div>
                                </x-card>
                            </div>
                        @endforeach
                    </div>
                </x-card>


                <!-- Timeline Display -->
                <x-card title="Thesis Timelines">
                    @foreach ($thesis->timelines as $entry)
                        <div class="mb-4">
                            <div class="text-sm font-bold">{{ $entry->stage }}</div>
                            <div class="text-xs text-gray-500">{{ $entry->status }} —
                                {{ $entry->date->format('d M Y') }}</div>
                        </div>
                    @endforeach
                </x-card>

                {{-- @if (auth()->user()->isSupervisor()) --}}
                <x-card title="Thesis Review">
                    <div class="flex flex-wrap gap-4">
                        <h3 class="font-bold">Latest Submission:</h3>
                        <a href="{{ route('thesis.download', $thesis->id) }}"
                            class="text-blue-600
                                        underline">Download
                            Thesis</a>
                    </div>

                    <livewire:thesis-amendment.form />

                </x-card>
                {{-- @endif --}}
            </div>
        </div>
    </div>
</x-app-layout>
