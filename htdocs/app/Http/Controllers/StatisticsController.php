<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;

class StatisticsController extends Controller {

    public function home() {
        $uId = Auth::id();
        return view('statistics.home', compact($uId));
    }
}
