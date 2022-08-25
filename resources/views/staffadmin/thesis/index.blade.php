<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Thesis / Dissertation List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!--  -->
                    <x-link href="{{ route('thesis.create') }}" class="mb-4">Assign Thesis / Dissertation</x-link>

                    @if(Session::has('message'))
                            <div class="bg-green-100 border border-green-400 my-4 text-green-700 px-4 py-3 rounded relative" role="alert">
  <!-- <strong class="font-bold">Holy smokes!</strong> -->
  <span class="block sm:inline">{{Session::get('message')}}</span>
  
</div>
                            @endif
                    <!--  -->
                    <div>
                        <livewire:thesis-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>