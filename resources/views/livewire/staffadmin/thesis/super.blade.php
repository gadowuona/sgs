<div>
@foreach($thesis->supervisors->reverse() as $supervisor)
    {{$supervisor->title}} {{$supervisor->user->name}} <br>
@endforeach
</div>
