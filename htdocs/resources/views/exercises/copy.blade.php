@extends('master')

@section('title')
    Add a copy of an exercise for series: {{$serie->title}}
@stop

@section('content')
    {!! Form::open() !!}
        <div class="form-group">
            {!! Form::submit('Add exercise', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    {!! Form::close() !!}

    @include('errors.list')
@stop
