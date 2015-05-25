<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PagesController extends Controller {

    public function home()
    {
	    \Session::forget('currentSerie');
        return view('pages.home');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function faqs()
    {
        return view('pages.faqs');
    }

    public function code()
    {
        return view('pages.code');
    }
}
