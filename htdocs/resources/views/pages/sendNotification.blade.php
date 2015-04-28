@extends('master')

@section('title')
    Send Notification
@stop

@section('content')
  			
          {!! Form::open(['action' => 'storeNotification()', '']) !!}
                <div class="form-group" >
                	{{ Form::select('receiver', array(
  					'user' => array('Fouad', 'Bruno', 'Raphael', 'Armin')
						))}}
                    {!! Form::submit('Send', ['class' => 'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}


                	<!--receiver : {{ Form::textarea('receiver') }}-->

<!-- 	<?php // dd(DB::table('notifications')->get()); ?>
<!--
	<h1>Sending a message</h1>

  	receiver: <input type="text" name="receiver" id="receiver"><br>
  	message: <input type="text" name="message" id="message"><br>
  	<!--<button onclick="add(document.getElementById('').value,document.getElementById('b').value)">Add</button>-->
 	<!--<button
 	onclick="return storeNotification(document.getElementById('$user').id, 'friends', document.getElementById('$user').id);">Share</button>   <br><br>

<!--	<div class="form-group">
        <label class="col-md-4 control-label"></label>
        <div class="col-md-6">
            <button id="derpderp" type="submit" class="btn btn-primary-large"
            onclick="return storeNotification(document.getElementById('$user').id, 'friends', document.getElementById('$user').id);">
                Login
            </button>
        </div>
    </div>	-->	
<!--
    <form name="myform">
    <textarea name="inputtext" rows="5" cols="30">Look buddy I just finished a new exercise! :D
    </textarea>
    <br><br>
    <input type="submit">   <br><br>
    <button name="Send" onclick="return storeNotification(add(document.getElementById('user').id, 'friends', document.getElementById('user').id);"/>   <br><br>
    </form>-->
@stop