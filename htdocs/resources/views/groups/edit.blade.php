@extends('master')

@section('title')
    Edit group: <em>{{ $group->name }}</em>
@stop

@section('content')
    <p>
        For now, only the name be updated... <br>
        In the future this should also list the members to manage them or something like that
    </p>

    {!! Form::model($group, ['method' => 'PATCH']) !!}
        <div class="form-group">
            {!! Form::label('name', 'Name of your group: ') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Update group', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    {!! Form::close() !!}

    @include('errors.list')
@stop

