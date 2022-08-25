<div>
    <form wire:submit.prevent="save">
        @csrf
        <div class="grid grid-cols-1  gap-5 ">

            <x-input label="Name" type="text" required wire:model.defer="name" />

            <x-input label="Email" type="email" required wire:model.defer="email" />

            <x-input label="Password" type="password" required wire:model.defer="password" />

            <x-input label="Confirm Password" type="password" required wire:model.defer="password_confirmation" />

            <x-native-select label="Role"
                :options="[['value' => '', 'name' => 'select one'], ['value' => 'STFADM', 'name' => 'Staff Admin'],['value' => 'FIN', 'name' => 'Financial'],]"
                option-label="name" option-value="value" wire:model.defer="role" required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button rose type="submit" spinner="save" :label="__('Submit')" />
        </div>
    </form>
</div>