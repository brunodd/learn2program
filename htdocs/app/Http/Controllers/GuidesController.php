<?php namespace App\Http\Controllers;

use App\Guide;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Http\Request;
use Request;    // Enable use of 'Request' in stead of 'Illuminate\Http\Request'
use App\Http\Requests\CreateGuideRequest;
use Auth;


class GuidesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$guides = loadAllGuides();
		return view('guides.home', compact('guides'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('guides.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateGuideRequest $request)
	{
        $input = $request->all();

        $newguide = new Guide;
        $newguide->title = $input['title'];
        $newguide->content = $input['content'];
        $newguide->writerId = Auth::id();

        storeGuide($newguide);
        $guide = loadGuideByTitleOrId($newguide->title)[0];
        return redirect('guides/' . $guide->title);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$guide = loadGuideByTitleOrId($id)[0];
        $author = loadUser($guide->writerId)[0];
        return view('guides.show', compact('guide', 'author'));
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
