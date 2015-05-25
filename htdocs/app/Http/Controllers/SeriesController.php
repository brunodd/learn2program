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
        \Session::forget('currentSerie');
        $series = loadAllDistinctSeries();
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
     * @param CreateSerieRequest $request
     * @return Response
     */
	public function store(CreateSerieRequest $request)
	{
        $input = $request->all();

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
        \Session::put('currentSerie', $id);
        $series = loadSerieWithIdOrTitle($id);
        if(empty($series))
        {
            flash()->error('That series does not exist.')->important();
            return redirect('series');
        }
        elseif( count($series) > 1)
        {
            //special case must be caught where multiple series exist with same title but only 1 serie contains exercises
            // -> redirect immediately
            $break = false;
            $serie = null;
            foreach( $series as $s)
            {
                $condition = (SerieContainsExercises($s->id) or ($s->makerId == Auth::id()) );
                if( $break and $condition ) return view('series.duplicates', compact('series'));
                elseif( $condition )
                {
                    $break = true;
                    $serie = $s;
                }
            }
            $type = loadType2($serie->tId)[0];
            $exercises = loadExercisesFromSerie($serie->id);
            return view('series.show', compact('serie', 'exercises', 'type'));
        }
        elseif( !SerieContainsExercises($series[0]->id) and !isMakerOfSeries($series[0]->id, Auth::id()) )
        {
            flash()->error('No exercises were found for this series. Come back later...')->important();
            return redirect('series/');
        }
        else
        {
            $serie = $series[0];
            $type = loadType2($serie->tId)[0];
            $exercises = loadExercisesFromSerie($serie->id);
            return view('series.show', compact('serie', 'exercises', 'type'));
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
        if(empty(loadSerieWithIdOrTitle($id)))
        {
            flash()->error('That series does not exist.')->important();
            return redirect('series');
        }
        else if (!isMakerOfSeries($id, Auth::id()) )
        {
            flash()->error('You must be logged in as the maker of this series in order to edit.')->important();
            return redirect('series/' . $id);
        }
        else
        {
            $serie = loadSerieWithIdOrTitle($id)[0];
            $type = loadType2($serie->tId)[0];
            return view('series.edit', compact('serie', 'type'));
        }
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param  UpdateSerieRequest $request
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
        updateSerie($input['id'], $serie, $typeId);

        //AUTOMATICALLY CLEAN UP UNUSED TYPES IF THAT'S THE CASE
        removeUnusedTypes();

        $myserie = loadSerie($serie->title, $typeId)[0];
        flash()->success('Your serie has been successfully updated.');
        return redirect('series/' . $myserie->id);
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

    public function createExercise($id)
    {
        if ( !isMakerOfSeries($id, Auth::id()) )
        {
            flash()->error('You must be logged in as the maker of this series in order to add exercises.')->important();
            return redirect('series/' . $id);
        }
        $serie = loadSerieWithId($id)[0];
        return view('exercises.create', compact('serie'));
    }

    public function referenceExercise($id)
    {
        if ( !userOwnsSeries(Auth::id()) )
        {
            flash()->error('You must own series in order to add exercises.')->important();
            return redirect('exercises/' . $id);
        }
        $myseries = loadMySeries();
        $series = [];
        foreach( $myseries as $serie ) {
            $series = ($series + [$serie->id => $serie->title]);
        }
        $exercise = loadExercise($id)[0];
        $exercise->expected_result = null;
        return view('exercises.reference', compact('series', 'exercise'));
    }

    public function copyExercise($id)
    {
        if ( !userOwnsSeries(Auth::id()) )
        {
            flash()->error('You must own series in order to add exercises.')->important();
            return redirect('exercises/' . $id);
        }
        $myseries = loadMySeries();
        $series = [];
        foreach( $myseries as $serie ) {
            $series = ($series + [$serie->id => $serie->title]);
        }
        $exercise = loadExercise($id)[0];
        $exercise->expected_result = null;
        return view('exercises.copy', compact('series', 'exercise'));
    }

    public function storeExercise($id, CreateExerciseRequest $request)
    {
        $input = $request->all();

        $exercise = new Exercise;
        $exercise->question = $input['question'];
        $exercise->tips = $input['tips'];
        $exercise->start_code = $input['start_code'];
        $exercise->expected_result = $input['expected_result'];
        $exercise->seriesId = $id;
        $exercise->makerId = Auth::id();
        $exercise->language = $input['language'];

        storeExercise($exercise);

        $userIds = loadUsersBeganSeries($id);
        foreach($userIds as $userId) {
            if ($userId->uId != loadSerieWithIdOrTitle($id)[0]->makerId) {
                storeNotification($userId->uId, 'series updated', -1, $id);
            }
        }
        return redirect('series/' . $id);
    }
    public function storeReference($id, Request $request)
    {
        $input = $request::all();

        addToSeries($id, $input['series_selection']);

        $userIds = loadUsersBeganSeries($input['series_selection']);
        foreach($userIds as $userId) {
            if ($userId->uId != loadSerieWithIdOrTitle($id)[0]->makerId) {
                storeNotification($userId->uId, 'series updated', -1, $input['series_selection']);
            }
        }
        storeNotification($input['makerId'], "exercise referenced", -1, $input['series_selection']);
        return redirect('series/' . $input['series_selection']);
    }

    public function storeCopy($id, CreateExerciseRequest $request)
    {
        $input = $request->all();

        $exercise = new Exercise;
        $exercise->question = $input['question'];
        $exercise->tips = $input['tips'];
        $exercise->start_code = $input['start_code'];
        $exercise->expected_result = $input['expected_result'];
        $exercise->seriesId = $input['series_selection'];
        $exercise->makerId = Auth::id();
        $exercise->language = $input['language'];

        storeExercise($exercise);

        $userIds = loadUsersBeganSeries($input['series_selection']);
        foreach($userIds as $userId) {
            if ($userId->uId != loadSerieWithIdOrTitle($id)[0]->makerId) {
                storeNotification($userId->uId, 'series updated', -1, $input['series_selection']);
            }
        }
        storeNotification($input['makerId'], "exercise copied", -1, $input['series_selection']);
        return redirect('series/' . $input['series_selection']);
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
        $newrating->seriesId = $input['sId'];

        //we already know that the "requester" hasn't rated this serie yet
        addRating($newrating);

        flash()->success("Your rating has been stored successfully.");
        return \Redirect::back();
    }

    public function updateRating($id, UpdateRatingRequest $request)
    {

    }

    public function mySeries() {
        $series = loadMySeries();
        return view('series.my_series', compact('series'));
    }
}
