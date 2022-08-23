<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Assign Thesis/Dissertation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!--  -->
                    <x-back-link href="{{ route('thesis.index') }}" class="mb-4">back</x-back-link>

                    <!--  -->
                    <div>
                        <livewire:staffadmin.thesis.form />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>