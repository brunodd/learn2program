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
    <script src="/js/addon/mode/loadmode.js"></script>
@stop

@section('title')
    Add a copy of an exercise to one of your series
@stop

@section('content')
    {!! Form::open() !!}
        {!! Form::label('series_selection', 'Choose one of your series: ') !!}
        {!! Form::select('series_selection', $series, "", ['class' => 'form-control']) !!}
        {!! Form::hidden('makerId', $exercise->makerId) !!}
        {!! Form::hidden('id', $exercise->id) !!}

        <div class="form-group">
            {!! Form::label('question', 'Question: ') !!}
	    {!! Form::text('question', $exercise->question, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('language', 'Language: ') !!}
            {!! Form::select('language', ['python'=>'Python', 'cpp'=>'C++'], null,
                ['class' => 'form-control', 'id' => 'lang', 'onchange'=>"changeSyntax();"]) !!}
        </div>

        <div class="form-group">
            {!! Form::label('start_code', 'Starting code, i.e. this code will initially be given to the user: ') !!}
	    {!! Form::textarea('start_code', $exercise->start_code, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('tips', 'Tips: ') !!}
	    {!! Form::textarea('tips', $exercise->tips, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('expected_result', 'Expected result, i.e. the output of the program: ') !!}
            <p>Note 1: The answer checks use regular expressions to match the generated result. If you want to match an exact answer, surround the expected result with the '^' and '$' symbols.
            For example: to match the string 'foo bar'. Enter ^foo bar$, if you merely want to check if the string 'foo' is in the text, just foo will suffice. 
            <em>(If you need some reminders on using regular expressions, visit <a href=http://lzone.de/examples/PHP%20preg_match>this cheat sheet</a>.)</em>
            </p>
            <p>Note 2: If you wish to create an exercise from which the result should/can not be verified <i>(e.g. turtle graphics)</i>.
            Please enter ' <font size="4">*</font> ' as the answer <i>(without the <b>'</b>-signs)</i>.
            </p>
            {!! Form::textarea('expected_result', null, ['class' => 'form-control']) !!}
        </div>


        <div class="form-group">
            {!! Form::submit('Add exercise', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    {!! Form::close() !!}

    @include('errors.list')

    <script>
        var editor;
        var language = $("#lang").val();
        CodeMirror.commands.autocomplete = function(cm) {
            cm.showHint({hint: CodeMirror.hint.anyword});
	    }
        CodeMirror.commands.autocomplete2 = function(cm) {
            cm.showHint({hint: CodeMirror.hint.show});
	    }
        if(language == 'cpp') {
            editor = CodeMirror.fromTextArea(document.getElementById("start_code"), {
            extraKeys: {"Ctrl-Space": "autocomplete2", "Alt-Space": "autocomplete"},
            mode: "text/x-c++src", styleActiveLine: true, lineNumbers: true,
                    lineWrapping: true, autoCloseBrackets: true, globarVars: true });
        } else {
            editor = CodeMirror.fromTextArea(document.getElementById("start_code"), {
            extraKeys: {"Ctrl-Space": "autocomplete2", "Alt-Space": "autocomplete"},
            mode: "python", styleActiveLine: true, lineNumbers: true,
                        lineWrapping: true, autoCloseBrackets: true, globarVars: true });
        }
        editor.on("change", function() { document.getElementById("start_code").value = editor.getValue() });
        function changeSyntax() {
            var m1 = "python";
            var m2 = "python";
            if( $("#lang").val() == 'cpp' ) {
                m1 = "text/x-c++src";
                m2 = "clike";
            }
            editor.setOption("mode", m1);
            CodeMirror.autoLoadMode(editor, m2);
        }
    </script>
@stop
