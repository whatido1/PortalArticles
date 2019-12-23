<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $category
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($category, $slug)
    {
        $Article = Article::where([
            [
                "category_id",
                "=",
                \App\Models\Category::where('slug', $category)->first()->id,
            ],
            [
                "slug",
                "=",
                $slug
            ]
        ])->first();

        return view('article', ["Article" => $Article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    /**
     * Search article by slug
     * 
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function category($slug) {
        $Category = \App\Models\Category::where("slug", $slug)->firstOrFail();


        return view('home', [
            "Articles" => $Category->article()->orderBy('created_at', 'desc')->paginate(5),
            "Category" => $Category,
            "Categories" => \App\Models\Category::all(),
            "Title" => "Category: {$Category->title}",
        ]);
    }
}
