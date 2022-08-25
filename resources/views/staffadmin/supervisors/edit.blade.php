<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Supervisor Registration Info') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                     <!--  -->
                     <x-back-link  href="{{ route('supervisors.index') }}" class="mb-4">back</x-back-link>

                    <!--  -->
                    @if(Session::has('message'))
                    <x-alert-success>{{Session::get('message')}}</x-alert-success>
                    @endif

                    <!--  -->
                    <div>
                        <livewire:staffadmin.supervisors.edit :supervisor="$supervisor" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>