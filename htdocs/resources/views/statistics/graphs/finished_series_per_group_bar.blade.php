<!-- brunodd: Get data from database -->
<?php
    $uId = 1;
    $count = countSeriesSucceededByUser($uId);
    $groupName = 'Group1';
    $username = loadName($uId)[0]->username;
    $users = [];
    array_push($users, $username);

?>
<!-- 3. Add the JavaScript with the Highchart options to initialize the chart -->
<script type="text/javascript">
$(function () {
    $('#container_succeeded_per_group').highcharts({
            chart: {
            type: 'column'
        },
        title: {
            text: <?php echo('\'Series succeeded per member of ' . $groupName . '\'');?>
        },
        xAxis: {
            title: {
                text: 'Users'
            },
            categories: <?php echo(json_encode($users)); ?>
        },
        yAxis: {
            title: {
                text: 'Amount created'
            },
            allowDecimals: false
        },
        series: [{
            name: 'Series completed',
            data: [<?php echo($count); ?>]
        }]
    });
});
</script>

