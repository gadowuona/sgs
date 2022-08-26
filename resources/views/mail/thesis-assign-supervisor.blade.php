@component('mail::message')

# hello, {{$supervisor->title}} {{$supervisor->last_name}}
You have been assigned as a {{$supervisor_thesis->supervisor_status }} to a thesis with the following information:

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