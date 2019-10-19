<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('isSuperAdmin')) {
            $data['title'] = "Dashboard";
            return view('admin.dashboard', $data);
        } else if (Gate::allows('isAdmin')) {
            $data['title'] = "Dashboard";
            return view('admin.dashboard', $data);
        } else if (Gate::allows('isManager')) {
            $data['title'] = "Dashboard";
            return view('manager.dashboard', $data);
        } else if (Gate::allows('isSupervisor')) {
            $data['title'] = "Dashboard";
            return view('supervisor.dashboard', $data);
        } else if (Gate::allows('isUser')) {
            $data['title'] = "Dashboard";
            return view('user.dashboard', $data);
        } else {
            abort(404, "Sorry, You can do this actions");
        }
    }
}
