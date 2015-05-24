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
    Add a referenced exercise to one of your series
@stop

@section('content')

    {!! Form::open() !!}
        {!! Form::label('series_selection', 'Choose one of your series: ') !!}
        {!! Form::select('series_selection', $series, "", ['class' => 'form-control']) !!}
        {!! Form::hidden('makerId', $exercise->makerId) !!}
        {!! Form::hidden('id', $exercise->id) !!}

        <div class="form-group">
            {!! Form::label('question', 'Question: ') !!}
            {!! Form::text('question', $exercise->question, ['class' => 'form-control', 'readonly']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('start_code', 'Starting code, i.e. this code will initially be given to the user: ') !!}
            {!! Form::textarea('start_code', $exercise->start_code, ['class' => 'form-control', 'readonly']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('tips', 'Tips: ') !!}
            {!! Form::textarea('tips', $exercise->tips, ['class' => 'form-control', 'readonly']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Add exercise', ['class' => 'btn btn-primary form-control']) !!}
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
            var editor = CodeMirror.fromTextArea(document.getElementById("start_code"), {
            extraKeys: {"Ctrl-Space": "autocomplete2", "Alt-Space": "autocomplete"},
            mode: "text/x-c++src", styleActiveLine: true, lineNumbers: true,
                    lineWrapping: true, autoCloseBrackets: true, globarVars: true, readOnly: true });
        } else {
            CodeMirror.commands.autocomplete = function(cm) {
                cm.showHint({hint: CodeMirror.hint.anyword});
	        }
            CodeMirror.commands.autocomplete2 = function(cm) {
                cm.showHint({hint: CodeMirror.hint.show});
	        }
            var editor = CodeMirror.fromTextArea(document.getElementById("start_code"), {
            extraKeys: {"Ctrl-Space": "autocomplete2", "Alt-Space": "autocomplete"},
            mode: "python", styleActiveLine: true, lineNumbers: true,
                        lineWrapping: true, autoCloseBrackets: true, globarVars: true, readOnly: true });
        }
    </script>
@stop
