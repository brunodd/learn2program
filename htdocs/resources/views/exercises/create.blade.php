@extends('master')

@section('head')
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
    Create a new exercise for {{$serie->title}}
@stop

@section('content')
    {!! Form::open() !!}
        <div class="form-group">
            {!! Form::label('question', 'Question: ') !!}
            {!! Form::text('question', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('start_code', 'Starting code, i.e. this code will initially be given to the user: ') !!}
            {!! Form::textarea('start_code', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('tips', 'Tips: ') !!}
            {!! Form::textarea('tips', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('language', 'Language: ') !!}
            {!! Form::select('language', array("python"=>"python", "cpp"=>"cpp"), ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('expected_result', 'Expected result, i.e. the output of the program: ') !!}
            <p>Note: If you wish to create an exercise from which the result should/can not be verified <i>(e.g. turtle graphics)</i>.
            Please enter ' <font size="4">*</font> ' as the answer <i>(without the <b>'</b>-signs)</i>.
            </p>
            {!! Form::textarea('expected_result', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Create exercise', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    {!! Form::close() !!}

    @include('errors.list')

    <script>
        var exercise = <?php echo json_encode($exercise) ?>;
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
