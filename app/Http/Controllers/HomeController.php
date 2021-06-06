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
        $assignments          = Assignment::count();
        $pollsters            = User::where('role', 'pollster')->count();
        $polls                = Poll::count();
        $periods_active       = Period::where('status', 1)->count();
        $periods_inactive     = Period::where('status', 0)->count();
        $routes               = Route::count();
        $customers            = Customer::count();
        $respondents          = DB::table('card_poll')->count();
        return view('panel.home', ['title' => 'Dashboard', 'pollsters' => $pollsters, 'assignments' => $assignments, 'polls' => $polls, 'periods_active' => $periods_active, 'periods_inactive' => $periods_inactive, 'routes' => $routes, 'customers' => $customers, 'respondents' => $respondents]);
    }
}
