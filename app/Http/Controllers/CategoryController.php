<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Categories = \App\Models\Category::orderBy('updated_at', 'desc')->paginate(10);
        return view('dashboard.admin.category.list', [
            "Categories" => $Categories,
            "title" => "List Category"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.admin.category.create', [
            "title" => "Create Category"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategory $request)
    {
        $Category = new \App\Models\Category();
        $Category->fill($this->formatRequestAll($request));
        $Category->save();

        return \redirect()->route('categories.index')->with(
            ["success" => "Berhasil menambahkan category"]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $Category = \App\Models\Category::where("slug", $slug)->firstOrFail();
        return view('dashboard.admin.category.edit', [
            "title" => "Update Category",
            'Category' => $Category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategory $request, $id)
    {
        //
        $Category = \App\Models\Category::find($id);
        $oldName = $Category->name;
        $Category->fill($this->formatRequestAll($request));
        $Category->save();

        return redirect()->route('categories.index')->with([
            "success" => "Berhasil mengubah category <strong>{$oldName}</strong>"
        ]);
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
     * Format request category
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    private function formatRequestAll($request) {
        $formatted = $request->all();
        $formatted['name'] = Str::title($request->name);
        $formatted['slug'] = Str::slug($request->slug);

        return $formatted;
    }
}
