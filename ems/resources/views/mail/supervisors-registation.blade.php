@component('mail::message')

# hi, {{$supervisor->first_name}}
kindly use the crdentials below to login into your portal

# Email - {{$supervisor->user->email}}
# Passwor - {{$password}}

Click on the link below to login into your account

@component('mail::button', ['url' => route('login')])
login
@endcomponent

Thank you,<br>
{{ config('app.name') }}

@endcomponent