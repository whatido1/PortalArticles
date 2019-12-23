<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticle;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;
class ArticleController extends Controller
{

    public function __construct()
    {
        // defining middleware to this controller
        $this->middleware('auth')->except('show');
        $this->middleware('isAdmin')->except('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Articles = \App\Models\Article::orderBy('updated_at', 'desc')->paginate(10);
        return view('dashboard.admin.article.list')->with([
            "Articles" => $Articles,
            "title" => "List Articles"    
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $Categories = \App\Models\Category::all();
        return view('dashboard.admin.article.create')->with([
            "Categories" => $Categories,
            "title" => "Create Article"
        ]);
    }

    private function uploadImage($file, $path = '/uploads/featured') {
        $originalBanner = $file;
        $thumbBanner = Image::make($originalBanner->getRealPath())->resize('200', null, function( $constraint ) {
            $constraint->aspectRatio();
        });
        $fileExt = $originalBanner->getClientOriginalExtension();
        $destThumbPath = \public_path('/uploads/featured') ."/200x_". $originalBanner->getClientOriginalName();
        $thumbBanner->save($destThumbPath);
        Storage::disk('public')->put($path . '/' . $originalBanner->getClientOriginalName(), File::get($originalBanner));

        return $originalBanner;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticle $request)
    {

        $path = '/uploads/featured';
        $originalBanner = $this->uploadImage($request->file('banner'), $path);

        $Article = new Article();
        $formattedRequest = $this->formatRequestAll($request);
        $Article->title = $formattedRequest['title'];
        $Article->slug = $formattedRequest['slug'];
        $Article->thumbnail = $path . "/200x_" . $originalBanner->getClientOriginalName();
        $Article->featured_image = $path . "/". $originalBanner->getClientOriginalName();
        $Article->content = $request->input('content');
        $Article->category_id = $request->input('category');
        $Article->user_id = Auth::id();

        $Article->save();

        return redirect()->route('articles.index')->with(["success" => "Berhasil menambahkan artikel <strong>". $Article->title ."</strong>"]);
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
        echo "show";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        return view('dashboard.admin.article.edit')->with([
            "title" => "Edit Article",
            "Article" => Article::where("slug", $slug)->firstOrFail(),
            "Categories" => \App\Models\Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(StoreArticle $request, $slug)
    {
        //
        $Article = \App\Models\Article::where("slug", $slug)->firstOrFail();
        $oldTitle = $Article->title;
        $Article->fill($this->formatRequestAll($request));
        if($request->has('banner')) {
            $path = "/uploads/featured";
            $originalBanner = $this->uploadImage($request->file('banner'), $path);
            $Article->thumbnail = $path . "/200x_" . $originalBanner->getClientOriginalName();
            $Article->featured_image = $path . "/". $originalBanner->getClientOriginalName();
        }
        $Article->category_id = $request->input('category');
        $Article->save();

        return redirect()->route('articles.index')->with(["success" => "Berhasil mengubah artikel <strong>". $oldTitle ."</strong>"]);
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
        $Article = \App\Models\Article::find($id);
        $title = $Article->title;
        $Article->delete();

        return redirect()->back()->with(["success" => "Berhasil menghapus artikel <strong>{$title}</strong>"]);
    }

    /**
     * Format request Article
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    private function formatRequestAll($request) {
        $formatted = $request->all();
        $formatted['title'] = Str::title($request->title);
        $formatted['slug'] = Str::slug($request->slug);

        return $formatted;
    }
}
