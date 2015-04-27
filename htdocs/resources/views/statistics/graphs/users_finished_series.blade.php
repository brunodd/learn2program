<!-- brunodd: Get data from database -->
<?php
    $data = countUsersSucceededSeries();
    // dd($data);
    $series = [];
    $num_finished = [];

    foreach($data as $d) {
        array_push($series, loadSerieWithId($d->seriesId)[0]->title);
        array_push($num_finished, (int) $d->c);
    }
?>

<!-- 3. Add the JavaScript with the Highchart options to initialize the chart -->
<script type="text/javascript">
$(function () {
    $('#container_user_finished_per_series').highcharts({
            chart: {
            type: 'column'
        },
        title: {
            text: <?php echo('\'Number of users that succesfully completed series\'');?>
        },
        xAxis: {
            title: {
                text: 'Series'
            },
            categories: <?php echo(json_encode($series)); ?>
        },
        yAxis: {
            title: {
                text: 'Users'
            },
            allowDecimals: false
        },
        series: [{
            name: 'Series completed',
            data: <?php echo(json_encode($num_finished)); ?>
        }]
    });
});
</script>

