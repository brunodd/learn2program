@extends('master')

@section('title')
    Edit <em>{{ $guide->title }}</em>
@stop

@section('content')
    <!-- TODO: armin PUT vs PATCH -->
    <div class="container col-md-8 col-md-offset-2">
        {!! Form::model($guide, ['url' => '/guides/' . $guide->title, 'method' => 'PUT']) !!}
            <div class="form-group">
                {!! Form::label('content', 'Content: ') !!}
                {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Update guide', ['class' => 'btn btn-primary pull-right']) !!}
            </div>
        {!! Form::close() !!}
    <div><br><br>
    @include('errors.list')
    </div>
</div>
@stop

