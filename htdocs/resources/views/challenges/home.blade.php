@extends('master')

@section('title')
Your challenges
@stop

@section('content')

@if(empty($challenges))
    No one dares challenge you!
@else
    <ul>
    @foreach($challenges as $challenge)
        {{-- Get opponent --}}
        @if ( $challenge->userA == \Auth::id() )
            <?php $name = loadUser($challenge->userB)[0]->username; ?>
            <li>Awaiting {{ $name }} for exercise {{ $challenge->exId }}.</li>
        @else
            <?php $name = loadUser($challenge->userA)[0]->username; ?>
            <li><a href="exercises/{{$challenge->exId}}">Beat {{ $name }} at exercise {{ $challenge->exId }}. </a></li>
        @endif
    @endforeach
    </ul>
@endif
@stop

