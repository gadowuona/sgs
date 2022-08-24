<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Thesis / Dissertation Detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!--  -->
                    <x-back-link href="{{ route('thesis.index') }}" class="mb-4">back</x-back-link>

                    <!--  -->
                    <div>
                        {{$thesis->supervisors}}
                        <x-card title="Your title here">
                            // code

                            <x-slot name="footer">
                                <div class="flex justify-between items-center">
                                    <x-button label="Delete" flat negative />
                                    <x-button label="Save" primary />
                                </div>
                            </x-slot>
                        </x-card>

                        <div class="grid grid-cols-2  gap-5 mt-4">
                            @foreach ($thesis->supervisors->reverse() as $supervisor)
                            <div class="my-4">
                                <x-card title="{{$loop->index == 0 ? 'Supervisor' : 'Co Supervisor' }}">

                                    <div class="flex">
                                        <div class="mr-4">
                                            @if($supervisor->picture)
                                            <x-avatar size="w-24 h-24"
                                                src="{{asset('assets/supervisor')}}/{{$supervisor->picture}}" />
                                            @else
                                            <x-avatar size="w-24 h-24" src="https://picsum.photos/300?size=24x" />
                                            @endif
                                        </div>
                                        <div>
                                            <p>
                                                {{$supervisor->title}}
                                                {{$supervisor->user->name}}
                                            </p>
                                            <p>
                                                {{$supervisor->user->email}}
                                            </p>
                                            <p>
                                                {{$supervisor->phone1}}
                                            </p>
                                        </div>
                                    </div>
                                </x-card>
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>