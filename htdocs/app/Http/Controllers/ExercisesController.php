<?php namespace App\Http\Controllers;

use App\Series;   // Added to find Serie model.
use App\Type;   // Added to find Type model.
use App\Exercise;
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
        $output = Request::all();
        return ($output['result']);
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
		return view('exercises.show', compact('exercise'));
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
        return $request->all();
        $input = $request->all();
        if ( $input['output'] )
        {
            return $input['output'];
        }
        else
        {
            return "no luck...";
        }
        //we must show the output when reloading the page, otherwise the output disappears...
        return redirect('exercises/' . $id);
    }

}
