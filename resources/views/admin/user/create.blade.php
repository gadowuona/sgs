<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">


                    <!--  -->
                    <x-back-link href="{{ route('users.index') }}" class="mb-4">back</x-back-link>

                    <!--  -->
                    @if(Session::has('message'))
                    <x-alert-success>{{Session::get('message')}}</x-alert-success>
                    @endif

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-auth-label for="name" :value="__('Name')" />

                            <x-auth-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" required autofocus />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-auth-label for="email" :value="__('Email')" />

                            <x-auth-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-auth-label for="password" :value="__('Password')" />

                            <x-auth-input id="password" class="block mt-1 w-full" type="password" name="password"
                                required autocomplete="new-password" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-auth-label for="password_confirmation" :value="__('Confirm Password')" />

                            <x-auth-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" required />
                        </div>
                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-auth-label for="role" :value="__('Role')" />

                            <x-auth-select id="role" class="block mt-1 w-full" type="password" name="role"
                                :value="old('role')" required>
                                <option value=""></option>
                                <option value="STFADM">Staff Admin</option>
                                <option value="FIN">Finance</option>
                            </x-auth-select>
                        </div>

                        <div class="flex items-center justify-end mt-4">

                            <x-auth-button class="ml-4">
                                {{ __('save') }}
                            </x-auth-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>