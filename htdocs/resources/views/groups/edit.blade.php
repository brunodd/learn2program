@extends('master')

@section('title')
    Edit group: <em>{{ $group->name }}</em>
@stop

@section('content')

    <!-- TODO: armin PUT vs PATCH -->
    <div class="container col-md-8 col-lg-offset-2">
        {!! Form::model($group, ['url' => '/groups/' . $group->name, 'method' => 'PUT']) !!}
            <div class="form-group">
                {!! Form::label('name', 'Name of your group: ') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('type', 'Type') !!}
                <div class="radio">
                    <label>
                        {!! Form::radio('type', 'public', $group->private ? false : true) !!}
                        Public
                    </label>
                    <label>
                        {!! Form::radio('type', 'private', $group->private ? true : false) !!}
                        Private
                    </label>
                </div>
            </div>

            <div class="form-group">
                <div style="color: white;">
                    <a href="{{ action('GroupsController@show', $group->name )}}" class="btn btn-primary pull-right" style="margin-left: 5px">
                        <i class="glyphicon glyphicon-remove-sign"></i> Cancel
                    </a>
                </div>
                {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right']) !!}
            </div>
            <div style="clear:both;"></div>
        {!! Form::close() !!}
        @include('errors.list')
    </div>
@stop

