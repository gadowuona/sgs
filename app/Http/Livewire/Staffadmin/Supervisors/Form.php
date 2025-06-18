<?php

namespace App\Http\Livewire\Staffadmin\Supervisors;

use App\Mail\SupervisorRegistration;
use App\Models\Supervisor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $staffid, $title, $first_name, $last_name, $middle_name, $email, $birthdate, $gender, $phone1, $phone2, $nid, $address, $collage, $fns, $faculty_school, $department, $qualification, $picture;


    protected function rules()
    {
        return [
            'staffid' => 'required|numeric|unique:supervisors',
            'title' => 'required',
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'middle_name' => 'nullable|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'birthdate' => 'nullable|date',
            'gender' => 'required',
            'phone1' => 'required|max:15',
            'phone2' => 'nullable|max:15',
            'nid' => 'required|string|max:20|unique:supervisors',
            'address' => 'nullable|string|max:255',
            'collage' => 'required|string|max:255',
            'fns' => 'required|string',
            'faculty_school' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'picture' => 'nullable|mimes:webp,jpeg,jpg,png',
        ];
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();

        DB::beginTransaction();

        try {
            // Build full name
            $name = trim($this->first_name . ' ' . ($this->middle_name ? $this->middle_name . ' ' : '') . $this->last_name);

            // Generate random password
            $password = Str::random(8);

            // Handle picture upload
            $pictureName = null;
            if ($this->picture) {
                $pictureName = Str::random(8) . Carbon::now()->timestamp . '.' . $this->picture->extension();
                $this->picture->storeAs('supervisor', $pictureName);
            }

            // Create user
            $user = User::create([
                'name' => $name,
                'email' => $this->email,
                'password' => Hash::make($password),
            ]);

            // Create supervisor
            $supervisor = Supervisor::create([
                'user_id' => $user->id,
                'staffid' => $this->staffid,
                'title' => $this->title,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'middle_name' => $this->middle_name,
                'birthdate' => $this->birthdate,
                'gender' => $this->gender,
                'phone1' => $this->phone1,
                'phone2' => $this->phone2,
                'nid' => $this->nid,
                'address' => $this->address,
                'collage' => $this->collage,
                'fns' => $this->fns,
                'faculty_school' => $this->faculty_school,
                'department' => $this->department,
                'qualification' => $this->qualification,
                'picture' => $pictureName,
            ]);

            DB::commit();

            // Send welcome email with credentials
            Mail::to($user->email)->send(new SupervisorRegistration($supervisor, $password));

            session()->flash('message', 'Supervisor was successfully registered.');
            return redirect()->route('supervisors.index');
        } catch (\Exception $e) {
            DB::rollBack();

            // Optionally log the error
            // Log::error($e);

            $this->notification()->error(
                'Error',
                'Failed to register supervisor: ' . $e->getMessage()
            );
        }
    }



    public function render()
    {
        return view('livewire.staffadmin.supervisors.form');
    }
}