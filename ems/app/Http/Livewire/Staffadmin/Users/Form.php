<?php

namespace App\Http\Livewire\Staffadmin\Users;

use Livewire\Component;

class Form extends Component
{
    public $staffid, $first_name, $last_name, $middle_name, $email, $birthday, $gender, $phone1, $phone2, $nid, $address, $collage, $fns, $faculty, $department, $qualification, $picture;


    protected function rules()
    {
        return [
            'staffid' => 'required|numeric|unique:profiles',
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'middle_name' => 'sometimes|max:20',
            'email' => 'required|string|email|max:255|unique:profiles',
            'birthday' => 'required|date',
            'gender' => 'required',
            'phone1' => 'required|max:15',
            'phone2' => 'sometimes|max:15',
            'nid' => 'required|string|max:20|unique:profiles',
            'address' => 'required|string|max:255',
            'collage' => 'required|string|max:255',
            'fns' => 'required|string',
            'faculty' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'picture' => 'required',
        ];
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        // Validate the fields before updating.
        dd(
            $this->validate()
        );
    }

    public function render()
    {
        return view('livewire.staffadmin.users.form');
    }
}