<?php namespace App\Http\Controllers;

use App\Series;   // Added to find Serie model.
use App\Type;   // Added to find Type model.
use App\Exercise;
use App\Rating;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Http\Request;
use Request;    // Enable use of 'Request' in stead of 'Illuminate\Http\Request'
use App\Http\Requests\CreateSerieRequest;
use App\Http\Requests\UpdateSerieRequest;
use App\Http\Requests\CreateExerciseRequest;
use App\Http\Requests\CreateRatingRequest;
use Auth;

class SeriesController extends Controller {

    /**
     * Middleware checks if the user is logged in
     *
     * veel beter dan overal checks doen en da geeft direct een overzicht wat public is en wat niet
     */
    public function __construct() {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }


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
        if ( !Auth::check() )
        {
            $msg = "You must be logged in to create a new serie.";
            $alert = "Access Denied!";
            return view('errors.unknown', compact('msg', 'alert'));
        }
        return view('series.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateSerieRequest $request)
	{
        //FIRST OF ALL, MUST CHECK IF THE "REQUESTER" IS LOGGED IN -> taken care of in create function

        $input = $request->all();

        // Create Serie object (model)
        $serie = new Series;
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
        $serie->makerId = Auth::id();

        // Store in Database
        storeSerie($serie);

        $myserie = loadSerie($serie->title, $serie->tId)[0];
        return redirect('series/' . $myserie->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        if(empty(loadSerieWithIdOrTitle($id))) {
            $msg = "Unknown series";
            $alert = "This series does not exist.";
            return view('errors.unknown', compact('msg', 'alert'));
        }
        elseif( !SerieContainsExercises2($id) and !isMakerOfSeries($id, Auth::id()) ) {
            $msg = "No exercises were found for this series. Come back later...";
            $alert = "No exercises found.";
            return view('errors.unknown', compact('msg', 'alert'));
        }
        else {
            //WILL ALSO NEED TO LOAD ALL EXERCISES THAT BELONG TO THIS SERIE
            // i.e. if we want to show them on the serie's home page
            $serie = loadSerieWithIdOrTitle($id)[0];
            $exercises = loadExercisesFromSerie2($id);
            return view('series.show', compact('serie', 'exercises'));
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
            $msg = "Unknown series";
            $alert = "This series does not exist.";
            return view('errors.unknown', compact('msg', 'alert'));
        }
        else if ( !Auth::check() or !isMakerOfSeries($id, Auth::id()) )
        {
            $msg = "You must be logged in as the maker of this series in order to edit.";
            $alert = "Access Denied!";
            return view('errors.unknown', compact('msg', 'alert'));
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

        $serie = new Series;
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

    public function createExercise($id)
    {
        if ( !Auth::check() )
        {
            $msg = "You must be logged in to create a new exercise.";
            $alert = "Access Denied!";
            return view('errors.unknown', compact('msg', 'alert'));
        }
        else if ( !isMakerOfSeries($id, Auth::id()) )
        {
            $msg = "You must be logged on as the maker of this series in order to add exercises.";
            $alert = "Access Denied!";
            return view('errors.unknown', compact('msg', 'alert'));
        }
        $serie = loadSerieWithId($id)[0];
        return view('exercises.create', compact('serie'));
    }

    public function storeExercise($id, CreateExerciseRequest $request)
    {
        $input = $request->all();

        // Create Serie object (model)
        $exercise = new Exercise;
        $exercise->question = $input['question'];
        $exercise->tips = $input['tips'];
        $exercise->start_code = $input['start_code'];
        $exercise->expected_result = $input['expected_result'];
        $exercise->serieId = $id;

        // Store in Database
        storeExercise($exercise);

        return redirect('series/' . $id);
    }

    public function storeRating($id, CreateRatingRequest $request)
    {
        $input = $request->all();
        if( $input['rating'] == null )
        {
            flash()->error("You must choose a value in order to rate this series.");
            return \Redirect::back();
        }

        $newrating = new Rating;
        $newrating->rating = $input['rating'];
        $newrating->userId = Auth::id();
        $newrating->serieId = $input['sId'];

        //we already know that the "requester" hasn't rated this serie yet
        addRating($newrating);

        flash()->success("Your rating has been successfully stored.");
        return \Redirect::back();
    }
}
