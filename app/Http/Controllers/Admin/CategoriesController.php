<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('management.categories.index')
            ->with('categories', Category::withCount('songs', 'beats', 'videos')->get());
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
        $this->validate($request, [
            'name' => 'required|unique:categories'
        ]);
        $cat = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        if($cat){
            return redirect()->back()->with('success', 'Category created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cat = Category::findOrFail($id)->load('songs', 'beats', 'videos');
        $songs = DB::table('songs')->where('category_id', $cat->id)->paginate(10);
        $beats = DB::table('beats')->where('category_id', $cat->id)->paginate(10);
        $videos = DB::table('videos')->where('category_id', $cat->id)->paginate(10);
        return view('management.categories.show')
            ->with('category', $cat)
            ->with('songs', $songs)
            ->with('beats', $beats)
            ->with('videos', $videos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('management.categories.edit')->with('category', Category::findOrFail($id));
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
        $this->validate($request, [
            'name' => 'unique:categories,name'
        ]);
        $cat = Category::findOrFail($id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route('categories.index')->with('success', 'Category updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if($category->songs->count() || $category->beats->count() || $category->videos->count() != 0){
            return redirect()->back()->with('error', 'Category canot be deleted now. Make sure it has no songs, videos, or beats!');
        }
        if($category->delete()){
            return redirect()->back()->with('success', 'Category is deleted success');
        }
    }
}
