<?php namespace App\Http\Controllers;

use App\Serie;   // Added to find Serie model.
use App\Type;   // Added to find Type model.
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Http\Request;
use Request;    // Enable use of 'Request' in stead of 'Illuminate\Http\Request'
use App\Http\Requests\CreateSerieRequest;
use App\Http\Requests\UpdateSerieRequest;

class SeriesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $series = loadAllSeries();
		return view('series.home', compact('series'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('series.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateSerieRequest $request)
	{
        //FIRST OF ALL, MUST CHECK IF THE "REQUESTER" IS LOGGED IN
        //otherwise deny this request!

        $input = $request->all();

        // Create Serie object (model)
        $serie = new Serie;
        $serie->title = $input['title'];
        $serie->description = $input['description'];

        //MUST find the type first according to the subject & difficulty
        $type = new Type;
        $type->subject = $input['subject'];
        $type->difficulty = $input['difficulty'];

        if(empty(loadType1($type)))
        {
            storeType($type);
        }

        $type = loadType1($type)[0];

        $serie->tId = $type->id;

        //STILL NEED TO FIND THE MAKER
        $serie->makerId = 1; //hard-coded for testing

        // Store in Database
        storeSerie($serie);

        $myserie = loadSerie($serie->title, $serie->tId)[0];
        return redirect('series/' . $myserie->id);
        //in the future, we may want to redirect to a "createExercise" page
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        if(empty(loadSerieWithId($id))) {
            $msg = "Unknown s";
            $alert = "This s doesn't exist.";
            return view('users.error', compact('msg', 'alert'));
        }
        else {
            //WILL ALSO NEED TO LOAD ALL EXERCISES THAT BELONG TO THIS SERIE
            // i.e. if we want to show them on the s's page
            $serie = loadSerieWithId($id)[0];
            //$exercises = loadExercisesFromSerie($id)[0];
            return view('series.show', compact('serie'));
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
        if(empty(loadSerieWithId($id))) {
            $msg = "Unknown s";
            $alert = "This s doesn't exist.";
            return view('users.error', compact('msg', 'alert'));
        }
        else {
            $serie = loadSerieWithId($id)[0];
            $type = loadType2($serie->tId)[0];
            return view('series.edit', compact('serie', 'type'));
        }
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, UpdateSerieRequest $request)
	{
        $input = $request->all();

        $serie = new Serie;
        $serie->title = $input['title'];
        $serie->description = $input['description'];
        $type = new Type;
        $type->subject = $input['subject'];
        $type->difficulty = $input['difficulty'];

        if(empty(loadType1($type)))
        {
            storeType($type);
        }

        $typeId = loadType1($type)[0]->id;
        updateSerie($id, $serie, $typeId);

        //AUTOMATICALLY CLEAN UP UNUSED TYPES IF THAT'S THE CASE
        removeUnusedTypes();

        $myserie = loadSerie($serie->title, $typeId)[0];
        return redirect('series/' . $myserie->id . '/edit');
		return "edited?";
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

}
