<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            "Articles" => \App\Models\Article::orderBy('created_at', 'desc')->paginate(5),
            "Title" => "Home Blog",
            "Categories" => \App\Models\Category::all(),
        ]);
    }
}
