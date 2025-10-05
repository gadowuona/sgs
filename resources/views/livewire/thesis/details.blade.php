<div>
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
</div>
