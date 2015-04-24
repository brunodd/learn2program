<!-- brunodd: Get data from database -->
<?php
    $total = countExercisesBySeries();
    $users = loadusers();
    if( count($users) > 0 ) {
        $avgs = countUserSucceededExercisesBySeries($users[0]->id);
        if( count($avgs) > 0 ) {
            for( $i = 1; $i < count($users); $i++ ) {
                 $userScores = countUserSucceededExercisesBySeries($users[$i]->id);
                 // Length of $userScores & $avgs SHOULD BE THE SAME! Otherwise something must have gone horribly wrong
                 for( $j=0; $j < count($avgs); $j++ ) {
                    // Again a "useless" safety check since this should allways match
                    if( $avgs[$j]->seriesId == $userScores[$j]->seriesId ) {
                        $avgs[$j]->c += $userScores[$j]->c;
                     }
                 }
            }
            // Again, length of $total & $avgs SHOULD BE THE SAME!
            for( $i=0; $i < count($avgs); $i++ ) {
                if( $total[$i]->seriesId == $avgs[$i]->seriesId && $total[$i]->c > 0 ) {
                    $avgs[$i]->c = $avgs[$i]->c / ($total[$i]->c * count($users));
                }
                elseif( $total[$i]->seriesId == $avgs[$i]->seriesId && $total[$i]->c == 0 ) $avgs[$i]->c = -1;
            }
        }
    }
    // dd($avgs);
    $series = [];
    $scores = [];
    foreach($avgs as $a) {
        if($a->c >= 0) {
            array_push($series, loadSerieWithId($a->seriesId)[0]->title);
            array_push($scores, ($a->c * 100));
        }
    }
?>
<!-- 3. Add the JavaScript with the Highchart options to initialize the chart -->
<script type="text/javascript">
$(function () {
    $('#container_avg_score_per_series').highcharts({
            chart: {
            type: 'column'
        },
        title: {
            text: "Average score per series"
        },
        xAxis: {
            title: {
                text: 'Series'
            },
            categories: <?php echo json_encode($series);?>
        },
        yAxis: {
            title: {
                text: 'Average Score (in %)'
            },
            allowDecimals: true
        },
        tooltip: {
            pointFormat: 'Average score over all users: <b>{point.y:.1f} %</b>'
        },
        series: [{
            name: 'Average score per series',
            data: <?php echo(json_encode($scores));?>
        }]
    });
});
</script>

