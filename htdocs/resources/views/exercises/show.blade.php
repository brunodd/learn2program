@extends('master')

@section('head')
    <script src="/js/skulpt.js"></script>
    <script src="/editarea/edit_area/edit_area_full.js"></script>
    <style>
        .mytooltip {
            color: white;
            float: right;
            position: relative;
        }

        .mytooltip:hover:after {
            content: attr(title);
            border-radius: 5px;
            background: rgba(0, 0, 0, .8);
            padding: 5px 15px;

            min-height: 26px;
            max-height: 500px;
            height: auto;
            width: 400px;
            position: absolute;
            right: 67px;
            top: -7px;
            z-index: 98;
            white-space: pre;
            word-wrap: break-word;
            overflow-y: auto;
        }

        .mytooltip:hover:before{
             border: solid;
             border-color: transparent transparent transparent #333;
             border-width: 10px 0 7px 15px;
             bottom: 20px;
             content: "";
             right: 52px;
             position: absolute;
             z-index: 97;
         }
    </style>
@stop

@section('title')
    <b><em>Exercise {{ ExNrOfSerie($exercise->id, $sId) }}</em></b>

    @if( Auth::check() and isMakerOfExercise($exercise->id, Auth::id()) )
        <a href="{{ action('ExercisesController@edit', $exercise->id )}}" style="float:right;color: #ffffff" class="btn btn-primary">Edit</a>
    @endif
    <div style="clear: both;"></div>
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

    <h3 style="float:left;margin-top: 0;padding-top: 0">{{ $exercise->question }}</h3>

    <div class="mytooltip" title="{{ str_replace('\n', '&#xa;', $exercise->tips) }}">
        <div title=" " class="btn btn-primary">Tips</div>
    </div>

    <div style="clear: both;"></div>

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

        <div id="yourcanvas"><!-- Canvas for turtle graphics --></div>
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

                @if( $answer != null )
                    <a href="/sendnotification/" class="btn btn-primary">Share with friend</a>
                @endif
            </div>

        @endif
    {!! Form::close() !!}

    @if( $answer != null )
        <script>
            skulptFunctions.runit();
        </script>
    @endif

    <pre>Expected output : {{ $exercise->expected_result }}</pre>
@stop
