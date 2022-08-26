<div>
    <form wire:submit.prevent="save" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1  gap-5 ">

            <x-input label="Thesis/Dissertation Title" type="text" placeholder="Thesis/Dissertation title" wire:model.defer="title" required />

            <x-input label="Appointment Date" type="date" wire:model.defer="appointment_date" required />

            <x-select label="Student Index Number" wire:model.defer="student" placeholder="Select a student" :async-data="route('api.student')" option-label="index_number" option-value="id" option-description="full_name" required />

        </div>
        <div class="my-4 text-xl font-semibold text-gray-700">
            {{ __('Assign Supervisors') }}
        </div>
        <div class="grid grid-cols-1  gap-5 ">

            <x-select label="Supervisor (Staff ID)" wire:model.defer="supervisor" placeholder="Select a Supervisor" :async-data="route('api.supervisor')" option-label="staffid" :template="['name'   => 'user-option','config' => ['src' => 'profile_image']]" option-value="id" option-description="user.name" required />

            <x-select label="Co-Supervisor (Staff ID, Optional)" wire:model.defer="co_supervisor" placeholder="Select a co-supervisor" :async-data="route('api.supervisor')" option-label="staffid" :template="['name'   => 'user-option','config' => ['src' => 'profile_image']]" option-value="id" option-description="user.name" />

        </div>
        <div class="flex items-center justify-end mt-4">
            <x-button rose type="submit" spinner="save" :label="__('Submit')" />
        </div>
    </form>
</div>