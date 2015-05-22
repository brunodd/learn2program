@extends('master')


@section('title')
    Edit <em>{{ $serie->title }}</em>
@stop

@section('content')
    <!-- TODO: armin PUT vs PATCH -->
    <div class="container col-md-8 col-md-offset-2">
        {!! Form::model($serie, ['url' => '/series/' . $serie->title, 'method' => 'PUT']) !!}
            <div class="form-group">
                {!! Form::label('title', 'Title: ') !!}
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Description: ') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
            </div>

            {!! Form::model($type, ['method' => 'PATCH']) !!}
            <div class="form-group">
                {!! Form::label('subject', 'Subject: ') !!}
                {!! Form::text('subject', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('difficulty', 'Difficulty: ') !!}
                {!! Form::select('difficulty', ['' => '', 'easy' => 'Easy', 'intermediate' => 'Intermediate', 'hard' => 'Hard', 'insane' => 'Insane'], null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::hidden('id', $serie->id) !!}
            </div>

            <div class="form-group">
                <div style="color: white;">
                    <a href="{{ action('SeriesController@show', $serie->id )}}" class="btn btn-primary pull-right" style="margin-left: 5px">
                        <i class="glyphicon glyphicon-remove-sign"></i> Cancel
                    </a>
                </div>
                {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right']) !!}
                <div style="clear: both"></div>
            </div>
        {!! Form::close() !!}
        @include('errors.list')
    </div>
@stop

