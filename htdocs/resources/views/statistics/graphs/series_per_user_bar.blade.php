<!-- brunodd: Get data from database -->
<?php
    $raw = countSeriesByMakers();
    $raw2 = countExercisesByMakers();
    $makers = [];
    $seriesCounter = [];
    $exercisesCounter = [];
    foreach($raw as $pair) {
        array_push($makers, loadName($pair->makerId)[0]->username);
        array_push($seriesCounter, (int) $pair->c);
    }
    foreach($raw2 as $pair) {
        array_push($exercisesCounter, (int) $pair->c);
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
            text: 'Contributions per user'
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

