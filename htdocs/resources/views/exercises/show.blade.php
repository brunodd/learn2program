<html> 
<head> 
@extends('master')
 
</head> 
<body> 

@section('title')
<em>Exercise {{ $exercise->id }}'s</em>
@stop

@section('content')

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script> 
<script src="../../../skulpt/dist/skulpt.min.js" type="text/javascript"></script> 
<script src="../../../skulpt/dist/skulpt-stdlib.js" type="text/javascript"></script> 
 
<script type="text/javascript"> 
// output functions are configurable.  This one just appends some text
// to a pre element.
function outf(text) { 
    var mypre = document.getElementById("output"); 
    mypre.innerHTML = mypre.innerHTML + text; 
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
</script> 
 
<h3>{{ $exercise->question }}</h3>
<p> {{ $exercise->tips }}</p> <br \>
<h4>Your code :</h4>

{!! Form::open() !!}
    <div class="form-group">
    {!! Form::textarea('start_code', $exercise->start_code, [ 'id' => 'yourcode', 'class' => 'form-control']) !!}
    </div>
  @if ( Auth::check() )
    <div class="form-group">
    {!! Form::button('Run', ['class' => 'btn btn-primary', 'onclick' => 'runit()']) !!}
    </div>
  @endif
{!! Form::close() !!}

<pre id="output" ></pre>
<pre>Expected output : {{ $exercise->expected_result }}</pre>
<!-- If you want turtle graphics include a canvas -->
<canvas id="mycanvas" ></mycanvas> 


@stop
