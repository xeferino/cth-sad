<?php

namespace App\Http\Controllers;

use App\Events\UserLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Poll;
use App\User;
use App\Route;
use App\Customer;
use App\PollOpen AS Period;
use App\Assignment;


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
    public function index()
    {
        event(new UserLogin(\Auth::user()));
        return view('panel.home', ['title' => 'Dashboard']);
    }
}
