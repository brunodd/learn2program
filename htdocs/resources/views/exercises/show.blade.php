<html>
<head>
@extends('master')

</head>
<body>

@section('title')
<em>Exercise {{ $exercise->id }}'s</em>
@if( Auth::check() and isMakerOfSeries($exercise->serieId, Auth::id()) )
<br>
<small><a href="{{ action('ExercisesController@edit', $exercise->id )}}">Edit</a></small>
@endif
@stop

@section('content')

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script>
<!-- <script src="../../../skulpt/dist/skulpt.min.js" type="text/javascript"></script> -->
<!-- <script src="../../../skulpt/dist/skulpt&#45;stdlib.js" type="text/javascript"></script> -->
<script src="http://www.skulpt.org/static/skulpt.min.js" type="text/javascript"></script> 
<script src="http://www.skulpt.org/static/skulpt-stdlib.js" type="text/javascript"></script> 

<script type="text/javascript">

// var result;

// output functions are configurable.  This one just appends some text
// to a pre element.
function outf(text) {
    var mypre = document.getElementById("output");
    mypre.innerHTML = mypre.innerHTML + text;
    result = text;
}
function builtinRead(x) {
    if (Sk.builtinFiles === undefined || Sk.builtinFiles["files"][x] === undefined)
            throw "File not found: '" + x + "'";
    return Sk.builtinFiles["files"][x];
}

// Here's everything you need to run a python program in skulpt
// grab the code from your textarea
// get a reference to your pre element for output
// configure the output function
// call Sk.importMainWithBody()
function runit() {
   var prog = document.getElementById("yourcode").value;
   var mypre = document.getElementById("output");
   mypre.innerHTML = '';
   Sk.canvas = "mycanvas";
   Sk.pre = "output";
   Sk.configure({output:outf, read:builtinRead});
   try {
      eval(Sk.importMainWithBody("<stdin>",false,prog));
   }
   catch(e) {
       alert(e.toString())
   }
}
function showResult() {
    runit();
    // alert("Your result = " + document.getElementById('output').innerHTML);
    //document.getElementById('result').innerHTML = document.getElementById('output').innerHTML;
}
</script>

<h3>{{ $exercise->question }}</h3>
<p> {{ $exercise->tips }}</p> <br \>
<h4>Your code :</h4>

{!! Form::open() !!}

    @if ( $answer === null )
    <div class="form-group">
        {!! Form::textarea('given_code', $exercise->start_code, [ 'id' => 'yourcode', 'class' => 'form-control']) !!}
    </div>
    @else
    <div class="form-group">
        {!! Form::textarea('given_code', $answer, [ 'id' => 'yourcode', 'class' => 'form-control']) !!}
    </div>
    @endif

    <button type="button" class="btn btn-primary" onclick="runit()">Run</button>

    <!-- If you want turtle graphics include a canvas -->
    <canvas id="mycanvas" height="400" width="400"
            style="border-style: solid; display: none"></canvas>

  @if ( Auth::check() )
    <div class="form-group">
    {!! Form::textarea('result', $result, [ 'id' => 'output', 'rows' => 5, 'class' => 'form-control', 'readonly']) !!}
    </div>

    <div class="form-group">
    {!! Form::submit('Submit', ['class' => 'btn btn-primary', 'onclick' =>  'runit()']) !!}
    </div>
  @endif
{!! Form::close() !!}


<pre>Expected output : {{ $exercise->expected_result }}</pre>
@stop
