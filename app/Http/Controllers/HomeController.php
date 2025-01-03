<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ModulPembelajaran;
use App\Models\Event;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count(); 
        $totalMentors = User::where('role', 'mentor')->count(); 
        $totalModuls = ModulPembelajaran::all()->count();
        $totalEvents = Event::all()->count();
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalMentors',
            'totalModuls',
            'totalEvents'
        ));
    }
}
