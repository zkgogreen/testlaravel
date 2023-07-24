<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Content;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $content = DB::table('content')->get();
        return view('pages.frontend.home',[
            'content' => $content,
        ]);
    }

    public function about()
    {
        $content = DB::table('content')->get();
        return view('pages.frontend.about',[
            'content' => $content,
        ]);
    }

    public function maps()
    {
        $density_layer = DB::table('user_tables')
        ->where([
            ['status', '=' , 'Active'],
            ['roles', '=', 'Public'],
            ])
        ->get();

        return view('pages.frontend.maps',[
            'density_layer' => $density_layer,
        ]);
    }
}
