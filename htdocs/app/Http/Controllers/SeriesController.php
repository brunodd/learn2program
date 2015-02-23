<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SeriesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('serie.home');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('serie.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateSerieRequest $request)
	{
        $input = $request->all();

        // Create User object (model)
        $serie = new Serie;
        $serie->title = $input['title'];
        $serier->description = $input['description'];
        
        //MUST find the type first according to the subject & difficulty
        //$serie->mail = $input['subject'];

        // Store in Databse & catch the newly inserted tuple
        $myserie = storeSerie($serie);

        return redirect('serie/' . $myserie->id . '/edit');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        if(empty(loadSerie($id))) {
            $msg = "Unknown user";
            $alert = "This user doesn't exist.";
            return view('user.error', compact('msg', 'alert'));
        }
        else {
            //WILL ALSO NEED TO LOAD ALL EXERCISES THAT BELONG TO THIS SERIE
            // i.e. if we want to show them on the serie's page
            $serie = loadSerie($id)[0];
            $exercises = loadExercisesFromSerie($id)[0];
            return view('serie.show', compact('serie', 'exercises'));
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
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
