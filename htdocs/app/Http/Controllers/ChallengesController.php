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
        $challengesA = [];
        $challengesB = [];

        foreach($_challenges as $c) {
            if ($c->winner == \Auth::id())
                array_push($challengesB, $c);
            else
                array_push($challengesA, $c);
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
            flash()->success("$user->username was challenged succefully");
        }
        else {
            flash()->error("This challenge already exists");
        }
        // dd(loadAnswers(\Auth::id(), $exId));
        $answersU1 = loadAnswers(\Auth::id(), $exId)[0];
        // dd(loadChallengesByUsers(\Auth::id(), $user->id));
        $challengeId = loadChallengeByUsersExercise(\Auth::id(), $user->id, $exId)[0]->id;
        if(!empty(loadAnswers($user->id, $exId))) {
            // dd('determining winner');
            $answersU2 = loadAnswers($user->id, $exId)[0];

            //U1 beats U2
            if ($answersU1->time < $answersU2->time) {
                setWinner($challengeId, \Auth::id());
            }
            // U2 beats U1
            else if ($answersU1->time > $answersU2->time) {
                setWinner($challengeId, $user->id);
            }
            // tie
            else {
                setWinner($challengeId, NULL);
            }
        }
        // U2 hasn't played yet -> U1 is winner.
        else {
            setWinner($challengeId, \Auth::id());
            // dd(loadChallenge($challengeId));
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
        // $user1 = loadUser($challenge->userA);
        // $user2 = loadUser($challenge->userB);

        if (!empty(loadAnswers($challenge->userA, $challenge->exId))) {
            $answersA = loadAnswers($challenge->userA, $challenge->exId)[0];
            if(!empty(loadAnswers($challenge->userB, $challenge->exId))) {
                $answersB = loadAnswers($challenge->userB, $challenge->exId)[0];

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
            if(!empty(loadAnswers($challenge->userB, $challenge->exId)))
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
