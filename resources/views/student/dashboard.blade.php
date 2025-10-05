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
            </div>
        </div>
    </div>
</x-app-layout>
