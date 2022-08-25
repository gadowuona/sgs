<div class="py-4">
    @if(Auth::user()->role === 'FIN')
    <x-local-dropdown align="left">
        <x-slot name="trigger">
            <button
                class="flex items-center text-sm font-bold hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out   focus:ring-2 focus:ring-offset-2 hover:shadow-sm disabled:opacity-80 disabled:cursor-not-allowed rounded gap-x-2 px-4 py-2     ring-green-600 text-green-600 hover:bg-green-100 dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:ring-green-700   uppercase">
                <div>Payment Status</div>

                <div class="ml-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </x-slot>

        <x-slot name="content">
            <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                href="#" wire:click.prevent="updateThesisPaidStatus({{$thesis->id}},'paid')">
                {{ __('Paid') }}
            </a>
            <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                href="#" wire:click.prevent="updateThesisPaidStatus({{$thesis->id}},'not-paid')">
                {{ __('Not Paid') }}
            </a>

        </x-slot>
    </x-local-dropdown>

    @elseif(Auth::user()->role === 'STFADM')

    <x-local-dropdown align="left">
        <x-slot name="trigger">
            <button
                class="flex items-center text-sm font-medium hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out    focus:ring-2 focus:ring-offset-2 hover:shadow-sm disabled:opacity-80 disabled:cursor-not-allowed rounded gap-x-2 px-4 py-2     ring-negative-600 text-negative-600 hover:bg-negative-100 dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:ring-negative-700   uppercase">
                <div>Payment Status</div>

                <div class="ml-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </x-slot>

        <x-slot name="content">
            <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                href="#" wire:click.prevent="updateThesisCompleteStatus({{$thesis->id}},'paid')">
                {{ __('Paid') }}
            </a>
            <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                href="#" wire:click.prevent="updateThesisCompleteStatus({{$thesis->id}},'not-paid')">
                {{ __('Not Paid') }}
            </a>

        </x-slot>
    </x-local-dropdown>
    @endif
</div>
</div>