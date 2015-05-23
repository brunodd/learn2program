@extends('master')

@section('head')
    <!-- 1. Add JQuery and Highcharts in the head of your page -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script src="http://code.highcharts.com/highcharts.js"></script>

    <!-- 2. You can add print and export feature by adding this line -->
    <script src="http://code.highcharts.com/modules/exporting.js"></script>

    @include('statistics.graphs.series_per_user_bar')
    @include('statistics.graphs.series_per_user_pie')
    @include('statistics.graphs.users_finished_series')
    @include('statistics.graphs.avg_score_series')
    @include('statistics.graphs.avg_rating_series')

    <style>
        .contain2 {
            max-width: 1220px;
            min-width: 602px;
            margin: 0 auto;
        }

        .contain2 * {
            margin-bottom: 15px;
        }

        .graph {
            width: 600px;
            height: 400px;
        }
    </style>
@stop

@section('title')
    Statistics
@stop

@section('content')
        <div class="notranslate">  <!-- Do not translate graphs -->

        <!-- 3. Add the container -->
        <div class="contain2">
            <div id="container_created_per_user" class="graph" style="float: left;"></div>
            <div id="container_pie_example" class="graph" style="float: right;"></div>
        </div>
        <div style="clear: both;"></div>

        <div class="contain2">
            <div id="container_user_finished_per_series" class="graph" style="float: left;"></div>
            <div id="container_avg_score_per_series" class="graph" style="float: right;"></div>
        </div>
        <div style="clear: both; margin-bottom: 15px"></div>

        <div id="container_avg_rating_per_series" class="graph" style="margin: 0 auto"></div>

        </div>
@stop
