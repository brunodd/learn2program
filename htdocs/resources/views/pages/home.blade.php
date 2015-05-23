@extends('master')

@section('title')
    Welcome to Learn2Program
@stop

@section('head')
    @include('web.homepagehead')
@stop

@section('content')
    <?php echo preg_match("/^foo bar$/", "foo bar"); ?>
    @include('web.homepagebody')
@stop
