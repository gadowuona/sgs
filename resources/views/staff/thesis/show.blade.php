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
                    <x-back-link href="{{ route('staff.thesis.index') }}" class="mb-4">back</x-back-link>
                    <!--  -->
                    @if(Session::has('message'))
                    <x-alert-success>{{Session::get('message')}}</x-alert-success>
                    @endif

                    <!--  -->
                    <div>
                        <div class="grid grid-cols-3 gap-5 mt-4">
                            <div>
                                Thesis / Dissertation Title
                            </div>
                            <div class="col-span-2">
                                {{$thesis->title}}
                            </div>
                            <div class="col-span-3 border-b"></div>
                            <div>
                                Appointment Date
                            </div>
                            <div class="col-span-2">
                                {{$thesis->appointment_date}}
                            </div>
                            <div class="col-span-3 border-b"></div>
                            <div>
                                Completed Status
                            </div>
                            <div class="col-span-2">
                                {{$thesis->complete_status}}
                            </div>
                            <div class="col-span-3 border-b"></div>
                            <div>
                                Payment Status
                            </div>
                            <div class="col-span-2">
                                {{$thesis->payment_status}}
                            </div>
                            <div class="col-span-3 border-b"></div>
                            <div>
                                Student
                            </div>
                            <div class="col-span-2">
                                <p>
                                    {{$thesis->student->index_number}}
                                </p>
                                <p>
                                    {{$thesis->student->full_name}}
                                </p>
                                <p>
                                    {{$thesis->student->email}}
                                </p>
                                <p>
                                    {{$thesis->student->programme}}
                                </p>
                                <p>
                                    {{$thesis->student->phone1}}
                                </p>
                                <p>
                                    {{$thesis->student->phone2}}
                                </p>
                            </div>
                            <div class="col-span-3 border-b"></div>
                        </div>

                        <div class="grid grid-cols-2  gap-5 mt-4">
                            @foreach ($thesis->supervisors->reverse() as $supervisor)
                            <div class="my-4">
                                <x-card title="{{$loop->index == 0 ? 'Supervisor' : 'Co Supervisor' }}">

                                    <div class="flex">
                                        <div class="mr-4">
                                            @if($supervisor->picture)
                                            <x-avatar size="w-24 h-24" src="{{asset('assets/supervisor')}}/{{$supervisor->picture}}" />
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
                                            <p>
                                                {{$supervisor->phone2}}
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