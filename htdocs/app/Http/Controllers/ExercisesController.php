<?php namespace App\Http\Controllers;

use App\Answer;   // Added to find Answer model.
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Http\Request;
use Request;    // Enable use of 'Request' in stead of 'Illuminate\Http\Request'
use App\Http\Requests\CreateAnswerRequest;
//use App\Http\Requests\CreateSerieRequest;
//use App\Http\Requests\UpdateSerieRequest;
//use App\Http\Requests\CreateExerciseRequest;
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
        $exercise = loadExercise($id)[0];
        $result = null;
        $answer = null;
		return view('exercises.show', compact('exercise', 'result', 'answer'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $exercise = loadExercise($id)[0];
        $serie = loadSerieWithId($exercise->serieId)[0];
		return view('exercises.edit', compact('exercise', 'serie'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		return $result;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public function storeAnswer($id, CreateAnswerRequest $request)
    {
        $exercise = loadExercise($id)[0];
        $input = $request->all();

        //must check for empty answers & stuff like that...
        //must also find a way to avoid duplicate answers since 'text' types can't be used as key

        $ans = new Answer;
        $ans->given_code = $input['given_code'];

        //something fishy happens here with the strings, hence the self written compare function
        //must test situations where output is shown on multiple lines!
        //ask raphael for more details!
        $ans->success = compare(bin2hex($input['result']), bin2hex($exercise->expected_result . chr(0x0d) . chr(0x0a)));
        $ans->uId = Auth::id();
        $ans->eId = $id;

        storeAnswer($ans);

        $result = $input['result'];
        $answer = $input['given_code'];
        // return view('exercises.show', compact('exercise', 'result', 'answer'));
    }

}
