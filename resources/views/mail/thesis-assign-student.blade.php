@component('mail::message')

# hello, {{$student->full_name}}
Your thesis / dissertation has have been assigned to a supervisor and a co-supervisor. Below are details about your
theses:

@component('mail::table')
| | |
| --------------------------- |:-------------------------------------:|
| Thesis / Dissertation Title | {{$student->thesis->title}} |
| Appointment Date | {{$student->thesis->appointment_date}} |
@foreach ($student->thesis->supervisors->reverse() as $supervisor)
| {{$loop->index == 0 ? 'Supervisor' : 'Co Supervisor' }} information | {{$supervisor->title}}{{$supervisor->user->name}}<br>{{$supervisor->user->email}}<br>{{$supervisor->phone1}}<br>{{$supervisor->phone2}}|
@endforeach
@endcomponent

Thank you,<br>
{{ config('app.name') }}

@endcomponent