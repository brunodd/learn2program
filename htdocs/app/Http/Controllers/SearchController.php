<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SearchController extends Controller {

	public function search(Request $request) {
        $searchword = $request->searchword;

        //TODO: sql queries for search

        $results = [ 'searchword' => $request->searchword, 'series' => '', 'exercises' => '', 'users' => '', 'graphs' => ''];
        return view('pages.search', compact('results'));
    }

}
