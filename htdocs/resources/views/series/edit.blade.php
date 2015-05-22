@extends('master')


@section('title')
    Edit <em>{{ $serie->title }}</em>
    <div style="float: right;color: white;"><a href="{{ action('SeriesController@show', $serie->id )}}" class="btn btn-primary">
        <i class="glyphicon glyphicon-remove-sign"></i> Cancel changes</a></div>
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
                {!! Form::submit('Update serie', ['class' => 'btn btn-primary pull-right']) !!}
            </div>
        {!! Form::close() !!}
    <div><br><br>
    @include('errors.list')
    </div>
</div>
@stop

