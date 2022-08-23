@component('mail::message')

# hello, {{$supervisor->first_name}}
You have been assign as a {{$supervisor_thesis->supervisor_status }} to a thesis with the following information:

@component('mail::table')
| | |
| --------------------------- |:-------------------------------------:|
| Thesis / Dissertation Title | {{$supervisor_thesis->thesis->title}} |
| Submission Date | {{$supervisor_thesis->thesis->submission_date}} |
| Due Date | {{$supervisor_thesis->thesis->due_date}} |
| Student | {{$supervisor_thesis->thesis->student->first_name}} {{$supervisor_thesis->thesis->student->middle_name}}
{{$supervisor_thesis->thesis->student->last_name}}
|
| Supervisor Status | {{$supervisor_thesis->supervisor_status }} |
@endcomponent
Thank you,<br>
{{ config('app.name') }}

@endcomponent