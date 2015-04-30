@extends('master')

@section('title')
    Edit group: <em>{{ $group->name }}</em>
@stop

@section('content')

    <!-- TODO: armin PUT vs PATCH -->
    <div class="container col-md-8 col-md-offset-2">
        <p>
            For now, only the name can be updated... <br>
            In the future this should also list the members to manage them or something like that
        </p> <br/>
        {!! Form::model($group, ['url' => '/groups/' . $group->name, 'method' => 'PUT']) !!}
            <div class="form-group">
                {!! Form::label('name', 'Name of your group: ') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Update group', ['class' => 'btn btn-primary pull-right']) !!}
            </div>
        {!! Form::close() !!}
    </div>

    @include('errors.list')
@stop

