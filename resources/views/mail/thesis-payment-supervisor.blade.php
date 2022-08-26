@component('mail::message')

# hello, {{$supervisor->title}} {{$supervisor->last_name}}
Payment has been made to a Thesis you {{$supervisor_thesis->supervisor_status === "supervisor" ? "supervised" : "co-supevised"  }}. The details of the thesis are as follow:

@component('mail::table')
| | |
| --------------------------- |:-------------------------------------:|
| Thesis / Dissertation Title | {{$supervisor_thesis->thesis->title}} |
| Appointment Date | {{$supervisor_thesis->thesis->appointment_date}} |
| Student | {{$supervisor_thesis->thesis->student->full_name}} |
| Supervisor Status | {{$supervisor_thesis->supervisor_status }} |
@endcomponent
Thank you,<br>
{{ config('app.name') }}

@endcomponent