<!-- brunodd: Get data from database -->
<?php
    // $total = countExercisesBySeries();
    // $users = loadusers();
    // $all_raw_scores = [];
    // foreach($users as $user) {
    //     array_push($all_raw_scores, countUserSucceededExercisesBySeries($user->id));
    // }
    // // dd($all_raw_scores);
    // $series = [];
    // $average = [];
    // foreach($all_raw_scores[0] as $s) {
    //     $series[$s->seriesId] = 0;
    // }
    // $average = $series;
    // $scores = [];
    // foreach($all_raw_scores as $user_score) {
    //     foreach($user_score as $series_user_score) {
    //         $series[$series_user_score->seriesId] = $series[$series_user_score->seriesId] + $series_user_score->c;
    //     }
    // }
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

