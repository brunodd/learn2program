@extends('master')

@section('title')
    Create a new group
@stop

@section('content')
    <div class="col-md-8 col-md-offset-2">
        @include('errors.list')
        {!! Form::open(['url' => 'groups']) !!}
            <div class="form-group">
                {!! Form::label('name', 'Name of your group: ') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('type', 'Type') !!}
                <div class="radio">
                    <label>
                        {!! Form::radio('type', 'public', true) !!}
                        Public
                    </label>
                    <label>
                        {!! Form::radio('type', 'private', false) !!}
                        Private
                    </label>
                </div>
            </div>

            <div class="form-group">
                {!! Form::submit('Create group', ['class' => 'btn btn-primary pull-right']) !!}
            </div>
        {!! Form::close() !!}
    </div>
    <br/>
    <div style="clear: both"></div>

@stop
