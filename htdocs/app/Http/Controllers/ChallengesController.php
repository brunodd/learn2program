<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ChallengesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	    $challenges = loadChallengesByUser(\Auth::id());
	    return view('challenges.home', compact('challenges'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($exId)
	{
	    $friends = loadMyFriends();
	    return view('challenges.create', compact('friends', 'exId'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($userId, $exId)
	{
	    $user = loadUser($userId)[0];
        storeChallenge(\Auth::id(), $user->id, $exId);
        flash()->success("$user->username was challenged succefully");

        $sId = \Session::get('currentSerie');
        $nextEx = nextExerciseofSerie($exId, $sId);
        if ($nextEx == []) {
            return redirect('series/');
        }
        else {
            return redirect('exercises/' . $nextEx[0]->id);
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
