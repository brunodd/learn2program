@extends('master')
@section('head')
        <!-- 1. Add JQuery and Highcharts in the head of your page -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="http://code.highcharts.com/highcharts.js"></script>

        <!-- 2. You can add print and export feature by adding this line -->
        <script src="http://code.highcharts.com/modules/exporting.js"></script>

        <!-- brunodd: Get data from database -->
        <?php 
            $raw = countSeriesByMakers();
            $raw2 = countExercisesByMakers();
            $makers = [];
            $seriesCounter = [];
            $exercisesCounter = [];
            foreach($raw as $pair) {
                array_push($makers, loadName($pair->makerId)[0]->username);
                array_push($seriesCounter, $pair->c);
            }
            foreach($raw2 as $pair) {
                array_push($exercisesCounter, $pair->c);
            }
        ?>
        <!-- 3. Add the JavaScript with the Highchart options to initialize the chart -->
        <script type="text/javascript">
        $(function () {
            $('#container_created_per_user').highcharts({
                 chart: {
                    type: 'column'
                },
                title: {
                    text: 'Created per user'
                },
                xAxis: {
                    title: {
                        text: 'Makers'
                    },
                    categories: <?php echo(json_encode($makers)); ?>
                },
                yAxis: {
                    title: {
                        text: 'Amount created'
                    },
                    allowDecimals: false
                },
                series: [{
                    name: 'Series',
                    data: <?php echo(json_encode($seriesCounter)); ?>
                }, {
                    name: 'Exercises',
                    data: <?php echo(json_encode($exercisesCounter)); ?>
                }]
            });
        });
        </script>
@stop

@section('content')
        <!-- 3. Add the container -->
        <div id="container_created_per_user" style="width: 600px; height: 400px; margin: 0 auto"></div>
@stop
