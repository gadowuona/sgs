<div>


    <form wire:submit.prevent="save" enctype="multipart/form-data">
        @csrf
        <!-- <div class="mb-4 text-xl font-semibold text-gray-700">
            {{ __('Contact Person') }}
        </div> -->

        <div class="grid grid-cols-2 gap-5">
            <x-input label="Staff ID" type="text" placeholder="Staff ID" name="staffid" required
                wire:model.defer="staffid" />

            <x-input label="First Name" type="text" placeholder="First Name" required wire:model.defer="first_name" />

            <x-input label="Middle Name" type="text" placeholder="Middle Name" wire:model.defer="middle_name" />

            <x-input label="Last Name" type="text" placeholder="Last Name" required wire:model.defer="last_name" />

            <x-input label="Email" type="email" placeholder="Enter Email" required wire:model.defer="email" />

            <x-input label="Birthdate" type="date" wire:model.defer="birthdate" />

            <x-native-select label="Gender"
                :options="[['value' => '', 'name' => 'select one'], ['value' => 'male', 'name' => 'Male'],['value' => 'female', 'name' => 'Female']]"
                option-label="name" option-value="value" wire:model.defer="gender" />

            <x-inputs.maskable label="Phone No. 1" mask="['(###) ###-####', '+# ### ###-####', '+## ## ####-####']"
                placeholder="Phone number 1" required wire:model.defer="phone1" />

            <x-inputs.maskable label="Phone No. 2 (optional)"
                mask="['(###) ###-####', '+# ### ###-####', '+## ## ####-####']" placeholder="Phone number 2"
                wire:model.defer="phone2" />

            <x-inputs.maskable label="ID Number (Ghana Card Only)" mask="AAA-#########-#" placeholder="GHA-000000000-0"
                required wire:model.defer="nid" />

            <div class="col-span-2">
                <x-textarea label="Address" placeholder="Enter Address" wire:model.defer="address" />
            </div>

            <x-native-select label="Faculty/School" :options="[['value' => '', 'name' => 'Select your College'], 
                ['value' => 'college of humanities and legal studies', 'name' => 'College of Humanities and Legal Studies'],
                ['value' => 'college of health and allied sciences', 'name' => 'College of Health and Allied Sciences'],
                ['value' => 'college of distance education', 'name' => 'College of Distance Education'],
                ['value' => 'college of education studies', 'name' => 'College of Education Studies'],
                ['value' => 'college of agricultural and natural sciences', 'name' => 'College of Agricultural and Natural Sciences'],
                ]" option-label="name" option-value="value" wire:model.defer="collage" />

            <x-native-select label="Faculty/School"
                :options="[['value' => '', 'name' => 'select one'], ['value' => 'faculty', 'name' => 'Faculty'],['value' => 'school', 'name' => 'School']]"
                option-label="name" option-value="value" wire:model.defer="fns" />

            <x-input label="Faculty/School" type="text" placeholder="Enter your Faculty / School title" required
                wire:model.defer="faculty_school" />

            <x-input label="Department" type="text" placeholder="Enter Department" required
                wire:model.defer="department" />

            <x-input label="Qualificaiton" type="text" placeholder="Enter Qualificaiton" required
                wire:model.defer="qualification" />

            <div class="">
                <x-auth-label for="picture" :value="__('Picture')" />
                <input type="file" wire:model.defer="newpicture" />
                <div class="mb-4">
                    @if($newpicture)
                    <img src="{{$newpicture->temporaryUrl()}}" class="max-h-[150px] text-center" alt="">
                    @else
                    <img src="{{asset('assets/supervisor')}}/{{$picture}}" class="max-h-[150px] text-center" alt="">
                    @endif
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button rose type="submit" spinner="save" :label="__('Update')" />
        </div>
    </form>
</div>