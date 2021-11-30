<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        return view('home');
    }

    public function result($result_id){
        $result = Result::find($result_id);
        return view('showResult', compact('result'));
    }
}
