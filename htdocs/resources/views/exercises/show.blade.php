@extends('master')

@section('head')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script>
<script src="http://www.skulpt.org/static/skulpt.min.js" type="text/javascript"></script>
<script src="http://www.skulpt.org/static/skulpt-stdlib.js" type="text/javascript"></script>
@stop

@section('title')
Exercise {{ ExNrOfSerie($exercise->id, $exercise->serieId) }} of <em>{{ loadSerieWithId($exercise->serieId)[0]->title }}</em>
@if( Auth::check() and isMakerOfSeries($exercise->serieId, Auth::id()) )
<br>
<small><a href="{{ action('ExercisesController@edit', $exercise->id )}}">Edit</a></small>
@endif
@stop

@section('content')
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
   Sk.pre = "output";
   Sk.configure({output:outf, read:builtinRead});
   (Sk.TurtleGraphics || (Sk.TurtleGraphics = {})).target = 'yourcanvas';
   var myPromise = Sk.misceval.asyncToPromise(function() {
       return Sk.importMainWithBody("<stdin>", false, prog, true);
   });
   myPromise.then(function(mod) {
       console.log('success');
   },
       function(err) {
       console.log(err.toString());
   });
}
</script>

<!-- Python Syntax Highlight!! -->
<script language="javascript" type="text/javascript" src="/editarea/edit_area/edit_area_full.js"></script>
<script language="javascript" type="text/javascript">
editAreaLoader.init({
  id : "yourcode"   // textarea id
  ,syntax: "python"      // syntax to be uses for highlighting
  ,start_highlight: true    // to display with highlight mode on start-up
});
</script>

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

    @if ( Auth::check() )
    <div class="form-group">
        {!! Form::textarea('result', $result, [ 'id' => 'output', 'rows' => 5, 'class' => 'form-control', 'readonly']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Submit Answer', ['class' => 'btn btn-primary', 'onclick' =>  'runit()']) !!}
    </div>

    <!-- If you want turtle graphics include a canvas -->
    <div id="yourcanvas">
    </div>

    @endif
{!! Form::close() !!}

@if( $answer != null )
    <script>runit()</script>
@endif

<pre>Expected output : {{ $exercise->expected_result }}</pre>

@stop
