<?php


function getAllUsersAnswers($user) {
	return DB::select(' SELECT *
						FROM users, answers
						WHERE users.id = answers.uId');
}

function getAllExercisesOfSeries($serie) {
	return DB::select(' SELECT *
						FROM exercises_in_series, exercises
						WHERE exercises_in_series.exId = exercises.id
						and exercises_in_series.seriesId = ?', [$serie->id]);
	//TODO: SORTEER DIE exercises
}

function getAccomplishedExercise($user, $exercise) {
	if (empty( DB::select(' SELECT *
							FROM users, answers, exercises
							WHERE answers.uId = ?
							and answers.eId = ?',
							[$user->id, $exercise->id]) ) ) 
	{
		return false;
	}
	return true;
}

function hasCompletedAllExercisesInSerie($user, $serie) {
	if( isEmptySeries($serie) ) {
		return false;
	}
	$exercises = getAllExercisesOfSeries($serie);
	foreach($exercises as $exercise) {
		if( !getAccomplishedExercise($user,$exercise) ) {
			return false;
		}
	}
	return true;
}

function hasNotCompletedWholeSerie($user, $serie) {
	if( isEmptySeries($serie) ) {
		return false;
	}
	$exercises = getAllExercisesOfSeries($serie);
	$completedOne = false;
	$notCompletedOne = false;
	foreach($exercises as $exercise) {
		if( !getAccomplishedExercise($user,$exercise) ) {
			$notCompletedOne = true;
		} else {
			$completedOne = true;
		}
	}
	if ($completedOne and $notCompletedOne) {
		return true;
	}
	return false;
}

function hasNotStartedSerie($user, $serie) {
	if( isEmptySeries($serie) ) {
		return false;
	}
	$exercises = getAllExercisesOfSeries($serie);
	foreach($exercises as $exercise) {
		if( getAccomplishedExercise($user,$exercise) ) {
			return false;
		}
	}
	return true;
}
