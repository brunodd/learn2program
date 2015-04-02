@extends('master')

@section('title')
    Create a new group
@stop

@section('content')
    {!! Form::open(['url' => 'groups']) !!}
        <div class="form-group">
            {!! Form::label('name', 'Name of your group: ') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Create group', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    {!! Form::close() !!}

    @include('errors.list')
@stop
