<!-- brunodd: Get data from database -->
<?php
    $raw = countSeriesByMakers();
    $seriesPerUser = [];
    foreach($raw as $pair) {
        $temp[0] = loadName($pair->makerId)[0]->username;
        $temp[1] = (int) $pair->c;
        array_push($seriesPerUser, $temp);
    }
?>

<script type="text/javascript">
$(function () {
    $('#container_pie_example').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Series created per user'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.y}',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Series per user',
            data: <?php echo(json_encode($seriesPerUser)); ?>
        }]
    });
});
</script>

