<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SearchController extends Controller {

	public function search(Request $request) {
        $s = $request->s;
        $series = loadSeriesSearch($s);
        $exercises = loadExercisesSearch($s);
        $users = loadUsersSearch($s);
        $groups = loadGroupsSeach($s);
        $guides = loadGuidesSearch($s);

        return view('pages.search', compact('s', 'series', 'exercises', 'users', 'groups', 'guides'));
    }

}
