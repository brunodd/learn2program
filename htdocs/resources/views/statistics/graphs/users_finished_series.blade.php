<!-- brunodd: Get data from database -->
<?php
    $data = countUsersSucceededSeries();
    $series = [];
    $num_finished = [];
    // function loadSerieWithId($id)

    foreach($data as $d) {
        array_push($series, loadSerieWithId($d->seriesId)[0]->title);
        array_push($num_finished, $d->c);
    }
    // $uId = 1;
    // $count = countSeriesSucceededByUser($uId);
    // $groupName = 'Group1';
    // $username = loadName($uId)[0]->username;
    // $users = [];
    // array_push($users, $username);

?>
<!-- 3. Add the JavaScript with the Highchart options to initialize the chart -->
<script type="text/javascript">
$(function () {
    $('#container_succeeded_per_group').highcharts({
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
                text: 'Amount created'
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

