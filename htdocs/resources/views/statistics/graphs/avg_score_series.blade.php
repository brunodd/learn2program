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
    //dd($avgs);
?>
<!-- 3. Add the JavaScript with the Highchart options to initialize the chart -->
<script type="text/javascript">
$(function () {
    $('#container_succeeded_per_group').highcharts({
            chart: {
            type: 'column'
        },
        title: {
            text: "title"
        },
        xAxis: {
            title: {
                text: 'Series'
            },
            categories: []
        },
        yAxis: {
            title: {
                text: 'score'
            },
            allowDecimals: false
        },
        series: [{
            name: 'Series completed',
            data: []
        }]
    });
});
</script>

