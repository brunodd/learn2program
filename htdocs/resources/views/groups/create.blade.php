@extends('master')

@section('title')
    <h1>Create a new group</h1>
@stop

@section('content')
    {!! Form::open(['url' => 'groups']) !!}
        <div class="form-group">
        {!! Form::label('name', 'Name of your group: ') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <div>
        {!! Form::submit('Create group', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    {!! Form::close() !!}

    @include('errors.list')
@stop
