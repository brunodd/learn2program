@extends('master')
@section('head')
        <!-- 1. Add JQuery and Highcharts in the head of your page -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="http://code.highcharts.com/highcharts.js"></script>

        <!-- 2. You can add print and export feature by adding this line -->
        <script src="http://code.highcharts.com/modules/exporting.js"></script>

        <!-- brunodd: Get data from database -->
        <?php 
            $series = loadAllSeries();
            $_seriesIds = DB::select('select id from series order by id');
            $seriesIds = [];
            foreach($_seriesIds as $id) {
                array_push($seriesIds, $id->id);
            }
            $_seriesMIds = DB::select('select makerId from series order by id');
            $seriesMIds = [];
            foreach($_seriesMIds as $mId) {
                array_push($seriesMIds, $mId->makerId);
            }
            $_makerIds = DB::select('select id from users order by id');
            $makerIds = [];
            foreach($_makerIds as $mId) {
                array_push($makerIds, $mId->id);
            }
        ?>
        <!-- 3. Add the JavaScript with the Highchart options to initialize the chart -->
        <script type="text/javascript">
        $(function () {
            $('#container').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Series overview',
                    x: -20 //center
                },
                xAxis: {
                    catgories: <?php echo(json_encode($makerIds)); ?>
                },
                yAxis: {
                    title: {
                        text: 'Maker (id)'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                tooltip: {
                    valuePrefix: 'Makers id: '
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                series: [{
                    name: 'Series',
                    data: <?php echo(json_encode($seriesMIds)); ?>
                }]
            });
        });
        </script>
@stop

@section('content')
        <!-- 3. Add the container -->
        <div id="container" style="width: 600px; height: 400px; margin: 0 auto"></div>
@stop
