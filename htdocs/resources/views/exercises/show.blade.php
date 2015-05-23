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

<link rel="stylesheet" href="/css/codemirror.css">
<link rel="stylesheet" href="/css/show-hint.css">
<script src="/js/codemirror.js"></script>
<script src="/js/mode/python/python.js"></script>
<script src="/js/mode/clike/clike.js"></script>
<script src="/js/addon/selection/active-line.js"></script>
<script src="/js/addon/edit/closebrackets.js"></script>
<script src="/js/addon/hint/show-hint.js"></script>
<script src="/js/addon/hint/anyword-hint.js"></script>
@stop

@section('title')
    <b><em>Exercise {{ ExNrOfSerie($exercise->id, $sId) }}</em></b>

    @if( Auth::check() and isMakerOfExercise($exercise->id, Auth::id()) )
        <a href="{{ action('ExercisesController@edit', $exercise->id )}}" class="btn btn-primary" style="float:right;color: #ffffff">
            <i class="glyphicon glyphicon-edit"></i> Edit
        </a>
    @endif
    <div style="clear: both;"></div>
@stop

@section('content')

    <?php $times = []; ?>
    <?php array_push($times, $startTime) ?>
    <!-- Python Syntax Highlight!! -->
    <script>
        $(window).load(function () {
            //myScripts.initPythonSyntax();
        });
        function RunPython() {
            //myScripts.initPythonSyntax();
            skulptFunctions.runit();
            result = skulptFunctions.result;
        }
        function RunCpp() {
            //myScripts.initPythonSyntax();
            var http = new XMLHttpRequest();
            http.open("POST", "http://coliru.stacked-crooked.com/compile", false);
            http.send(JSON.stringify({ "cmd": "g++-4.8 main.cpp && ./a.out", "src": document.getElementById("yourcode").value }));
            document.getElementById("output").value = http.response;
        }
        function Run() {
            var exercise = <?php echo json_encode($exercise) ?>;
            if( (exercise.expected_result == '*' && <?php echo $answer ? 'true' : 'false'; ?>)
                    || (exercise.expected_result != '*') ) {
                if(exercise.language == 'python') {
                    RunPython();
                } else if(exercise.language == 'cpp') {
                    RunCpp();
                } else {
                    //alert("Problem: No programming language found -> using Python by default ");
                    RunPython();
                }
            }
        }
    </script>

    <h3 style="float:left;margin-top: 0;padding-top: 0">{{ $exercise->question }}</h3>

    <div class="mytooltip" title="{{ str_replace('\n', '&#xa;', $exercise->tips) }}">
        <div title=" " class="btn btn-primary">Tips</div>
    </div>

    <div style="clear: both;"></div>
    <h4>Your code :</h4>

    {!! Form::open(['action' => ['ExercisesController@storeAnswer', $exercise->id]]) !!}
        {!! Form::text('start_time', $startTime, ['id' => 'startTime', 'readonly', 'hidden']) !!}
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
                {!! Form::submit('Submit Answer', ['class' => 'btn btn-primary', 'onclick' => 'Run();stopTimer()']) !!}
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

                @if( $answer != null && Session::has('correctAnswer'))
                    <a href="/sendnotification/" class="btn btn-primary">Share with friend</a>
                    @if($exercise->expected_result != '*')
                        <a href="/exercises/{{ $exercise->id }}/challenge/" class = "btn btn-primary"> Challenge a friend</a>
                    @endif

                @elseif( !empty(loadCorrectAnswers(\Auth::id(), $exercise->id)) && $exercise->expected_result != '*')
                    <a href="/exercises/{{ $exercise->id }}/challenge/" class = "btn btn-primary"> Challenge a friend</a>
                @endif
            </div>

        @endif
    {!! Form::close() !!}

    {{-- <pre>Expected output : {{ $exercise->expected_result }}</pre> --}}

    @if( Auth::check() && userOwnsSeries(Auth::id()) )
    <h4><a href="/exercises/{{$exercise->id}}/referenceexercise">Reference this exercise in one of your series</a></h4>
            <p><em>(This means that the you 'add' the original exercise to your series. You will have no rights for altering the exercise.
            When the original exercise gets updated (or deleted), so will this one.)</em></p>
            <h4><a href="/exercises/{{$exercise->id}}/copyexercise">Copy this exercise into one of your series</a></h4>
            <p><em>(This means that you become the new and sole author of the exercise. All the changes are your own.)</em></p>
    @endif

    <script>
        var exercise = <?php echo json_encode($exercise) ?>;
        if( (exercise.expected_result == '*' && <?php echo $answer ? 'true' : 'false'; ?>) ) skulptFunctions.runit();

        if(exercise.language == 'cpp') {
            CodeMirror.commands.autocomplete = function(cm) {
                cm.showHint({hint: CodeMirror.hint.anyword});
	        }
            CodeMirror.commands.autocomplete2 = function(cm) {
                cm.showHint({hint: CodeMirror.hint.show});
	        }
            var editor = CodeMirror.fromTextArea(document.getElementById("yourcode"), {
            extraKeys: {"Ctrl-Space": "autocomplete2", "Alt-Space": "autocomplete"},
            mode: "text/x-c++src", styleActiveLine: true, lineNumbers: true,
                    lineWrapping: true, autoCloseBrackets: true, globarVars: true });
            editor.on("change", function() { document.getElementById("yourcode").value = editor.getValue() });
        } else {
            CodeMirror.commands.autocomplete = function(cm) {
                cm.showHint({hint: CodeMirror.hint.anyword});
	        }
            CodeMirror.commands.autocomplete2 = function(cm) {
                cm.showHint({hint: CodeMirror.hint.show});
	        }
            var editor = CodeMirror.fromTextArea(document.getElementById("yourcode"), {
            extraKeys: {"Ctrl-Space": "autocomplete2", "Alt-Space": "autocomplete"},
            mode: "python", styleActiveLine: true, lineNumbers: true,
                        lineWrapping: true, autoCloseBrackets: true, globarVars: true });
            editor.on("change", function() { document.getElementById("yourcode").value = editor.getValue() });
        }
    </script>
@stop
