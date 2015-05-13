<?php namespace App\Http\Controllers;

use App\Answer;   // Added to find Answer model.
use App\Timer;
use App\Exercise;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Request;    // Enable use of 'Request' in stead of 'Illuminate\Http\Request'
use App\Http\Requests\CreateAnswerRequest;
use Auth;

class ExercisesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$exercises = [];
        if( Auth::check() ) $exercises = loadAllAccessableExercises(Auth::id());
        else $exercises = loadAllFirstExercises();
		return view('exercises.home', compact('exercises'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//handled in SeriesController
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//handled in SeriesController
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $startTime = microtime(true);
        $sId = \Session::get('currentSerie');
        $series = loadSerieWithIdOrTitleAndExercise($sId, $id);
        if( empty($series) ) {
            $series = loadSeriesWithExercise($id);
            if( count($series) == 1 ) $sId = $series[0]->id;
            elseif( count($series) > 1 ) return view('series.duplicates', compact('series'));
            else {
                flash()->error("Something went horribly wrong. Try reproducing the problem & notify the devs please...")->important();
                return redirect('/');
            }
        }
        elseif( count($series) == 1 ) $sId = $series[0]->id;
        elseif( count($series) > 1 ) return view('series.duplicates', compact('series'));
        else {
                flash()->error("Something went horribly wrong. Try reproducing the problem & notify the devs please...")->important();
                return redirect('/');
        }
        \Session::put('currentSerie', $sId);

        if( completedAllPreviousExercisesOfSeries($id, Auth::id(), $sId) or isMakerOfExercise($id, Auth::id())
                                                                        or isMakerOfSeries($sId, Auth::id()) )
        {
            $exercise = loadExercise($id)[0];
            $result = null;
            $answer = null;
            if (\Session::has('result')) $result = \Session::pull('result', '');
            if (\Session::has('answer')) $answer = \Session::pull('answer', '');

		    return view('exercises.show', compact('exercise', 'result', 'answer', 'sId', 'startTime'));
        }
        else {
            flash()->error("You must first complete one or more preceding exercises.");
            $exercise = nextExerciseInLine($id, Auth::id(), $sId)[0];
            $result = null;
            $answer = null;
            return redirect('exercises/' . $exercise->exId);
        }
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        if( isMakerOfExercise($id, Auth::id()) ) {
            $exercise = loadExercise($id)[0];
            $subjectSeries = loadSeriesWithExercise($id);
		    return view('exercises.edit', compact('exercise', 'subjectSeries'));
        }
        else {
            flash()->error("You must be logged in as the maker of this exercise.");
            return redirect('exercises/' . $id);
        }
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
	    $input = $request::all();
	    $exercise = new Exercise;

        $exercise->question = $input['question'];
        $exercise->tips = $input['tips'];
        $exercise->start_code = $input['start_code'];
        $exercise->expected_result = $input['expected_result'];
        $exercise->id = $id;

        updateExercise($exercise);

        return redirect('exercises/' . $id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//TODO
	}

    public function storeAnswer($id, CreateAnswerRequest $request)
    {
        $input = $request->all();

        // Get time between exercise load and store answer.
        $endTime = microtime(true);
        $diffTime = $endTime - $input['start_time'];

        $exercise = loadExercise($id)[0];

        //must check for empty answers & stuff like that...
        //must also find a way to avoid duplicate answers since 'text' types can't be used as key
        $ans = new Answer;
        $ans->given_code = $input['given_code'];
        $ans->time = $diffTime;

        if($exercise->expected_result == '*') {
            $ans->success = true;
        }
        else {
            $rule = "/" . $exercise->expected_result . "/";
            // dd($rule);
            if(preg_match($rule, $input['result'])) {
                $ans->success = true;
            }
            //something fishy happens here with the strings, hence the self written compare function
            //must test situations where output is shown on multiple lines!
            //ask raphael for more details!
            elseif (compare(bin2hex($input['result']), bin2hex($exercise->expected_result . chr(0x0d) . chr(0x0a)))) {
                $ans->success = true;
            }
            else {
                $ans->success = false;
            }
        }

        $ans->uId = Auth::id();
        $ans->eId = $id;

        storeAnswer($ans);

        if($exercise->expected_result != '*') {
            if( $ans->success ) {
                flash()->success("You solved the exercise in " . $diffTime . " seconds.");
                \Session::flash('correctAnswer', 'blabla');
            }
            else flash()->error("Too bad, the answer was wrong.");
        }


        $result = $input['result'];
        $answer = $input['given_code'];
        // TODO: return redirect('exercises/' . $id);
        $sId = \Session::get('currentSerie');

        $challenges = loadChallengesByUserExercise(\Auth::id(), $id);
        // Only update challenge if the given answer is correct. 
        if( $ans->success) {
            foreach($challenges as $c) {
                if ($c->winner != \Auth::id()) {
                    if($c->userA == \Auth::id()) {
                        if ($diffTime < loadCorrectAnswers($c->userB, $id)[0]->time) {
                            $newScore = loadUser(\Auth::id())[0]->score;
                            $newScore += 1;
                            setUserScore(\Auth::id(), $newScore);
                            setWinner($c->id, \Auth::id());

                            storeNotification($c->userB, "challenge beaten", \Auth::id(), $c->id);
                        }
                    }
                    else {
                        if ($diffTime < loadCorrectAnswers($c->userA, $id)[0]->time) {
                            $newScore = loadUser(\Auth::id())[0]->score;
                            $newScore += 1;
                            setUserScore(\Auth::id(), $newScore);
                            setWinner($c->id, \Auth::id());
                            storeNotification($c->userA, "challenge beaten", \Auth::id(), $c->id);
                        }
                    }
                }
            }
        }
        // dd($challenges);

        return redirect('exercises/' . $id)->with(['result' => $result, 'answer' => $answer]);
    }

    public function myExercises() {
        $exercises = loadMyExercises();
        return view('exercises.my_exercises', compact('exercises'));
    }

}
