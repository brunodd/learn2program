<?php namespace App\Http\Controllers;

use App\Answer;   // Added to find Answer model.
use App\Timer;
use App\Exercise;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Request;    // Enable use of 'Request' in stead of 'Illuminate\Http\Request'
use App\Http\Requests\CreateAnswerRequest;
use App\Http\Requests\CreateExerciseRequest;
use Auth;

class ExercisesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $exercises = loadAllExercises();
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

        $exercise = loadExercise($id)[0];
        if( $exercise->expected_result != "*" ) $exercise->expected_result = null;
        $result = null;
        $answer = null;
        if (\Session::has('result')) $result = \Session::pull('result', '');
        if (\Session::has('answer')) $answer = \Session::pull('answer', '');

        return view('exercises.show', compact('exercise', 'result', 'answer', 'sId', 'startTime'));
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
	public function update($id, CreateExerciseRequest $request)
	{
        if( !isMakerOfExercise($id, Auth::id()) ) {
            flash()->error("You must be logged in as the maker of this exercise.");
            return redirect('exercises/' . $id);
        }
        $input = $request->all();
	    $exercise = new Exercise;

        $exercise->question = $input['question'];
        $exercise->tips = $input['tips'];
        $exercise->start_code = $input['start_code'];
        $exercise->expected_result = $input['expected_result'];
        $exercise->language = $input['language'];
        $exercise->id = $id;

        updateExercise($exercise);
        flash()->success('Your exercise has been successfully updated.');
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

        $result = preg_replace('/[^A-Za-z0-9\-\ ,\.;:\[\]\?\!@#$%&\*\(\)\-=\+\.^\P{C}\n]/', '', $input['result']);
        // dd($result);

        // dd(preg_match("/^[hH]ello, [wW]orld$/", substr_replace($result, "", -1)));
        // dd(preg_match("/^Hello, world$/", $result));

        if($exercise->expected_result == '*') {
            $ans->success = true;
        }
        else {
            $rule = "/" . $exercise->expected_result . "/";
            // dd($rule);
            if(preg_match($rule, $result)) {
                $ans->success = true;
            }
            //something fishy happens here with the strings, hence the self written compare function
            //must test situations where output is shown on multiple lines!
            //ask raphael for more details!
            elseif (compare(bin2hex($result), bin2hex($exercise->expected_result . chr(0x0d) . chr(0x0a)))) {
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


        // $result = $input['result'];
        $answer = $input['given_code'];
        $sId = \Session::get('currentSerie');

        $challenges = loadChallengesByUserExercise(\Auth::id(), $id);
        // Only update challenge if the given answer is correct. 
        if( $ans->success) {
            foreach($challenges as $c) {
                if ($c->winner != \Auth::id()) {
                    if($c->userA == \Auth::id()) {
                        if (!empty(loadCorrectAnswers($c->userB, $id)) && $diffTime < loadCorrectAnswers($c->userB, $id)[0]->time) {
                            $newScore = loadUser(\Auth::id())[0]->score;
                            $newScore += 1;
                            setUserScore(\Auth::id(), $newScore);
                            setWinner($c->id, \Auth::id());

                            storeNotification($c->userB, "challenge beaten", \Auth::id(), $c->id);
                        }
                    }
                    else {
                        if (!empty(loadCorrectAnswers($c->userA, $id)) && $diffTime < loadCorrectAnswers($c->userA, $id)[0]->time) {
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

        return redirect('exercises/' . $id)->with(['result' => $result, 'answer' => $answer]);
    }

    public function myExercises() {
        $exercises = loadMyExercises();
        return view('exercises.my_exercises', compact('exercises'));
    }

    public function cpp() {
        return view('partials.cpp');
    }

}
