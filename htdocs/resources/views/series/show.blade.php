<html> 
<head> 
@extends('master')
 
</head> 
<body> 

@section('title')
    <em>{{ $serie->title }}'s</em> page <br>
    <small>
        Subject : {{$type->subject}}<br>
        Difficulty : {{$type->difficulty}}
        @if( Auth::check() and isMakerOfSeries($serie->id, Auth::id()) )
            <br>
            @if( count(loadSerieWithIdOrTitle($serie->title)) === 1 )
            <a href="{{ action('SeriesController@edit', $serie->title )}}">Edit</a>
            @else
            <a href="{{ action('SeriesController@edit', $serie->id )}}">Edit</a>
            @endif
        @endif
    </small>
@stop

@section('content')
    <h2>Description :</h2>
    <p>{{$serie->description}}</p>
    <h2>List of {{ $serie->title }}'s exercises :</h2>
    @if ( $exercises )
    @foreach ( $exercises as $ex )
    <h4><a href="../exercises/{{$ex->id}}">Exercise {{$ex->id}}</a></h4>
    @endforeach
    @endif
    @if ( $serie->makerId === Auth::id() )
    <h3><a href="{{$serie->id}}/newexercise">Add a new exercise</a></h3>
    @endif

    <br \> <br \>
    @if( unratedSeries($serie->id) )
    <h4>No ratings found for this series.</h4>
    @else
    <h4>Average rating : {{ averageRating($serie->id) }} / 5</h4>
    @endif

    @if ( Auth::check() and notRatedYet(Auth::id(), $serie->id))
        <br \> <br \>
        {!! Form::open() !!}
            <div class="form-group">
            {!! Form::label('rating', 'Rate this series: ') !!}
            {!! Form::select('rating', [null => 'Select rating...', '0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5']) !!}
            </div>
            <div class="form-group">
            {!! Form::hidden('sId', $serie->id) !!}
            </div>
            <div class="form-group">
            {!! Form::submit('Submit rating', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    @endif
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

<!--
<h3>Try This</h3> 
<form> 
<textarea id="yourcode" cols="40" rows="10">
def hello(name):
    print("Hello, " + name)

myName = ""


hello(myName)
</textarea><br /> 
<button type="button" onclick="runit()">Run</button> 
</form> 
<pre id="output" ></pre> 
<!-- If you want turtle graphics include a canvas >
<canvas id="mycanvas" ></mycanvas -->


@stop
