<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class StatisticsController extends Controller {

    public function home() {
        return view('statistics.home');
    }
}