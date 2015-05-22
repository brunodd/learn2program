<!-- brunodd: Get data from database -->
<?php
    $num_exercises_per_series = countExercisesBySeries();
    $users = loadusers();
    if( count($users) > 0 ) {
        $avg_scores_per_series = countUserSucceededExercisesBySeries($users[0]->id);
        foreach($avg_scores_per_series as $entry) {
            $entry->c = 0;
        }
        if( count($avg_scores_per_series) > 0 ) {

            // Get an array of the number of users that tried to solve the
            // series.
            $active_users_per_series = [];
            foreach($num_exercises_per_series as $ex) {
                array_push($active_users_per_series, 0);
            }

            // Fill avg_scores_per_series[] with the amount of correct
            // exercises (over all users).
            foreach($users as $user) {
                $user_scores_per_series = countUserSucceededExercisesBySeries($user->id);

                // Length of $user_scores_per_series & $avg_scores_per_series SHOULD BE THE SAME! Otherwise something must have gone horribly wrong
                // Iterate over all series.
                for( $j = 0; $j < count($avg_scores_per_series); $j++ ) {
                    // Again a "useless" safety check since this should allways match
                    if( $avg_scores_per_series[$j]->seriesId == $user_scores_per_series[$j]->seriesId ) {
                        $avg_scores_per_series[$j]->c += $user_scores_per_series[$j]->c;
                    }
                    if( attemptedSeries($user->id, $avg_scores_per_series[$j]->seriesId)) {
                        $active_users_per_series[$j] += 1;
                    }
                }
            }

            // Calculate the average scores in avg_score_per_series[].
            for( $i = 0; $i < count($avg_scores_per_series); $i++ ) {
                // Protection against division by 0.
                if($active_users_per_series[$i] == 0) {
                    $active_users_per_series[$i] = 1;
                }

                if( $num_exercises_per_series[$i]->seriesId == $avg_scores_per_series[$i]->seriesId && $num_exercises_per_series[$i]->c > 0 ) {
                    // $avg_scores_per_series[$i]->c = $avg_scores_per_series[$i]->c / ($num_exercises_per_series[$i]->c * count($users));
                    $avg_scores_per_series[$i]->c = $avg_scores_per_series[$i]->c / ($num_exercises_per_series[$i]->c * $active_users_per_series[$i]);
                }
                elseif( $num_exercises_per_series[$i]->seriesId == $avg_scores_per_series[$i]->seriesId && $num_exercises_per_series[$i]->c == 0 ) {
                    $avg_scores_per_series[$i]->c = -1;
                }
            }

            // dd($avg_scores_per_series);
            $series = [];
            $scores = [];
            foreach($avg_scores_per_series as $a) {
                if($a->c >= 0) {
                    array_push($series, loadSerieWithId($a->seriesId)[0]->title);
                    array_push($scores, ($a->c * 100));
                }
            }
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
            categories: <?php echo json_encode(isset($series) ? $series: 0);?>
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
            data: <?php echo(json_encode(isset($scores) ? $scores: 0));?>
        }]
    });
});
</script>

