<!-- brunodd: Get data from database -->
<?php

    $data = averageRatingsBySeries();
    // dd($data);
    $series = [];
    $ratings = [];
    foreach($data as $a) {
        $seriesId = $a[0];
        $rating = $a[1];
        if($rating >= 0) {
            array_push($series, loadSerieWithId($seriesId)[0]->title);
            array_push($ratings, $rating);
        }
    }
?>
<!-- 3. Add the JavaScript with the Highchart options to initialize the chart -->
<script type="text/javascript">
$(function () {
    $('#container_avg_rating_per_series').highcharts({
            chart: {
            type: 'column'
        },
        title: {
            text: "Average rating per series"
        },
        xAxis: {
            title: {
                text: 'Series'
            },
            categories: <?php echo json_encode($series);?>
        },
        yAxis: {
            title: {
                text: 'Average rating'
            },
            allowDecimals: true
        },
        tooltip: {
            pointFormat: 'Average rating: <b>{point.y:.1f}</b>'
        },
        series: [{
            name: 'Average rating per series',
            data: <?php echo(json_encode($ratings));?>
        }]
    });
});
</script>

