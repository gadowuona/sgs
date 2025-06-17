<div>
    <form wire:submit.prevent="save" enctype="multipart/form-data">
        @csrf
        <!-- <div class="mb-4 text-xl font-semibold text-gray-700">
            {{ __('Contact Person') }}
        </div> -->

        <div class="grid grid-cols-2 gap-5">
            <div class="col-span-2">
                <x-input label="Full Name" type="text" placeholder="Full Name" required wire:model.defer="full_name" />
            </div>

            <x-input label="Email" type="email" placeholder="Enter Email" required wire:model.defer="email" />

            <x-input label="Index Number" type="text" placeholder="Index Number" required
                wire:model.defer="index_number" class="uppercase" />

            <x-input label="Programme" type="text" required wire:model.defer="programme" />

            <x-native-select label="Gender" :options="[
                ['value' => '', 'name' => 'select one'],
                ['value' => 'male', 'name' => 'Male'],
                ['value' => 'female', 'name' => 'Female'],
            ]" option-label="name" option-value="value"
                wire:model.defer="gender" />

            <x-inputs.maskable label="Phone No. 1" mask="['(###) ###-####', '+# ### ###-####', '+## ## ####-####']"
                placeholder="Phone number 1" required wire:model.defer="phone1" />

            <x-inputs.maskable label="Phone No. 2 (optional)"
                mask="['(###) ###-####', '+# ### ###-####', '+## ## ####-####']" placeholder="Phone number 2"
                wire:model.defer="phone2" />

        </div>
        <div class="flex items-center justify-end mt-4">
            <x-button rose type="submit" spinner="save" :label="__('Submit')" />
        </div>
    </form>
</div>
