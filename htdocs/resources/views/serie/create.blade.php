@extends('master')

@section('title')
    <h1>Create a new serie</h1>
@stop

@section('content')
    {!! Form::open(['url' => 'serie/create']) !!}
        {!! Form::label('title', 'Title: ') !!}
        {!! Form::text('title') !!}

        {!! Form::label('description', 'Description: ') !!}
        {!! Form::textarea('description') !!}
        
        {!! Form::label('subject', 'Subject: ') !!}
        {!! Form::text('subject') !!}

        {!! Form::label('difficulty', 'Difficulty: ') !!}
        {!! Form::select('subject', ['E' => 'Easy', 'M' => 'Intermediate', 'H' => 'Hard', 'I' => 'Insane']) !!}


        {!! Form::submit('Create serie') !!}
    {!! Form::close() !!}

    @if ($errors->any())
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @endif
@stop
