@extends('master')

@section('title')
    Create a new guide
@stop

@section('content')
<div class="container col-md-8 col-md-offset-2">
    {!! Form::open(['url' => '/guides']) !!}
        <div class="form-group">
            {!! Form::label('title', 'Title: ') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('content', 'Content: ') !!}
            {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
        </div>


        <div class="form-group">
            {!! Form::submit('Create guide', ['class' => 'btn btn-primary pull-right']) !!}
        </div>
    {!! Form::close() !!}
    <div><br><br>
    @include('errors.list')
    </div>
</div>
@stop
