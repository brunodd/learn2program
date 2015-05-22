@extends('master')

@section('title')
    Edit group: <em>{{ $group->name }}</em>
@stop

@section('content')

    <!-- TODO: armin PUT vs PATCH -->
    <div class="container col-md-8 col-lg-offset-2">
        @include('errors.list')
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
                {!! Form::submit('Update group', ['class' => 'btn btn-primary pull-right']) !!}
            </div>
        {!! Form::close() !!}
    </div>
@stop

