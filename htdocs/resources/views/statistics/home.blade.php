@extends('master')

@section('head')
    <!-- 1. Add JQuery and Highcharts in the head of your page -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script src="http://code.highcharts.com/highcharts.js"></script>

        <!-- 2. You can add print and export feature by adding this line -->
        <script src="http://code.highcharts.com/modules/exporting.js"></script>
        
        @include('statistics.graphs.series_per_user_bar')

        @include('statistics.graphs.series_per_user_pie')


        @include('statistics.graphs.finished_series_per_group_bar')

@stop

@section('title')
    Statistics
@stop

@section('content')

        <!-- 3. Add the container -->
        <span class="notranslate">
        <div id="container_created_per_user" style="width: 600px; height: 400px; margin: 0 auto"></div>
        </span>
        <div id="container_pie_example" style="width: 600px; height: 400px; margin: 0 auto"></div>
        <div id="container_succeeded_per_group" style="width: 600px; height: 400px; margin: 0 auto"></div>

@stop
