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
	    $_challenges = loadChallengesByUser(\Auth::id());
	    // dd($_challenges);
        $challengesA = [];
        $challengesB = [];

        foreach($_challenges as $c) {
            $user = [];
            if($c->userA == \Auth::id()) {
                $user = loadUser($c->userB)[0];
            }
            else {
                $user = loadUser($c->userA)[0];
            }

            if ($c->winner == \Auth::id()) {
                array_push($challengesB, $c);
            }
            else {
                array_push($challengesA, $c);
            }
        }

	    return view('challenges.home', compact('challengesA', 'challengesB'));
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

        if(loadChallengeByUsersExercise(\Auth::id(), $user->id, $exId) == []) {
            storeChallenge(\Auth::id(), $user->id, $exId);
            $challengeId = loadChallengeByUsersExercise(\Auth::id(), $user->id, $exId)[0]->id;
            setWinner($challengeId, \Auth::id());

            $newScore = loadUser(\Auth::id())[0]->score+1;
            setUserScore(\Auth::id(), $newScore);
            flash()->success("$user->username was challenged succefully");
            storeNotification($user->id, "challenged", \Auth::id(), $challengeId);
        }
        else {
            flash()->error("This challenge already exists");
        }

        $sId = \Session::get('currentSerie');
        $nextEx = nextExerciseofSerie($exId, $sId);
        if ($nextEx == [])
            return redirect('series/');
        return redirect('exercises/' . $nextEx[0]->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $challenge = loadChallenge($id)[0];

        if (!empty(loadCorrectAnswers($challenge->userA, $challenge->exId))) {
            $answersA = loadCorrectAnswers($challenge->userA, $challenge->exId)[0];
            if(!empty(loadCorrectAnswers($challenge->userB, $challenge->exId))) {
                $answersB = loadCorrectAnswers($challenge->userB, $challenge->exId)[0];

                //A beats B
                if ($answersA->time < $answersB->time)
                    setWinner($id, $challenge->userA);
                // B beats A
                else if ($answersA->time > $answersB->time)
                    setWinner($id, $challenge->userB);
                // tie
                else
                    setWinner($id, NULL);
            }
            // B not answered => A wins
            else
                setWinner($id, $challenge->userA);
        }
        else {
            // A not answered => B wins
            if(!empty(loadCorrectAnswers($challenge->userB, $challenge->exId)))
                setWinner($id, $challenge->userB);
            // No one answered => tie
            else
                setWinner($id, NULL);
        }

        return view('challenges.show', compact('challenge'));
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
