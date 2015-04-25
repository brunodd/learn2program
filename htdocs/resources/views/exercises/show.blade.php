@extends('master')

@section('head')
    <script src="/js/skulpt.js"></script>
    <script src="/editarea/edit_area/edit_area_full.js"></script>
@stop

@section('title')
<em>Exercise {{ ExNrOfSerie($exercise->id, $sId) }}</em>

    @if( Auth::check() and isMakerOfExercise($exercise->id, Auth::id()) )
        <br>
        <small><a href="{{ action('ExercisesController@edit', $exercise->id )}}">Edit</a></small>
    @endif
@stop

@section('content')

    <!-- Python Syntax Highlight!! -->
    <script>
        myScripts.initPythonSyntax();
        function Run() {
            myScripts.initPythonSyntax();
            skulptFunctions.runit();
        }
    </script>

    <h3>{{ $exercise->question }}</h3>
    <p> {{ $exercise->tips }}</p> <br \>
    <h4>Your code :</h4>

    {!! Form::open(['action' => ['ExercisesController@storeAnswer', $exercise->id]]) !!}
        @if ( $answer === null )
            <div class="form-group">
                {!! Form::textarea('given_code', $exercise->start_code, [ 'id' => 'yourcode', 'class' => 'form-control']) !!}
            </div>
        @else
            <div class="form-group">
                {!! Form::textarea('given_code', $answer, [ 'id' => 'yourcode', 'class' => 'form-control']) !!}
            </div>
        @endif

        @if ( Auth::check() )
            <div class="form-group">
                {!! Form::textarea('result', $result, [ 'id' => 'output', 'rows' => 5, 'class' => 'form-control', 'readonly']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Submit Answer', ['class' => 'btn btn-primary', 'onclick' => 'Run()']) !!}
                @if( !empty(nextExerciseOfSerie($exercise->id, Session::get('currentSerie')))
                        && (userCompletedExercise($exercise->id, Auth::id())
                        || isMakerOfSeries(Session::get('currentSerie'), Auth::id())
                        || isMakerOfExercise(nextExerciseOfSerie($exercise->id, Session::get('currentSerie'))[0]->id, Auth::id())) )
                    <a href="/exercises/{{ nextExerciseOfSerie($exercise->id, Session::get('currentSerie'))[0]->id }}"
                        class="btn btn-primary">Next exercise</a>
                @elseif( empty(nextExerciseOfSerie($exercise->id, Session::get('currentSerie')))
                        && (userCompletedExercise($exercise->id, Auth::id())
                        || isMakerOfSeries(Session::get('currentSerie'), Auth::id())))
                    <a href="/series/"
                        class="btn btn-primary">Finished series</a>
                @endif
            </div>

            <div id="yourcanvas"><!-- Canvas for turtle graphics --></div>
        @endif
    {!! Form::close() !!}

    @if( $answer != null )
        <script>
            skulptFunctions.runit();
        </script>
    @endif

            <pre>Expected output : {{ $exercise->expected_result }}</pre>
@stop
