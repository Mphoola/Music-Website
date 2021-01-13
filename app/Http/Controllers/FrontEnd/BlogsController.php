<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Post;
use App\Song;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    public function index(){
        $popular = $this->popular();
        $most_downloads = Song::where('market', 'free')->orderBy('downloads_count', 'desc')->take(5)->get();
        return view('FrontEnd.blogs')
            ->with('popular_posts', $popular)
            ->with('most_downloads', $most_downloads)
            ->with('posts', Post::orderBy('published_at', 'desc')->simplePaginate(4));
    }

    public function show($slug){
        $post = Post::where('slug', $slug)->firstOrFail()->load('author', 'comments');

        $popular = $this->popular();
        $most_downloads = Song::where('market', 'free')->orderBy('downloads_count', 'desc')->take(5)->get();

        $post->increment('views', 1);
        return view('FrontEnd.singleBlog')
            ->with('post', $post)
            ->with('most_downloads', $most_downloads)
            ->with('popular_posts', $popular);
    }

    public function comment(Request $request, $slug){
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'content' => 'required|string'
        ]);

        $post = Post::where('slug', $slug)->firstOrFail();
        $post->comments()->create([
            'creator_name' => $request->name,
            'creator_email' => $request->email,
            'content' => $request->content
        ]);

        if($post){
            return redirect()->back()->with('success', 'You have successfully commented on this post');
        }
    }

    private function popular(){
        return Post::orderBy('views', 'desc')->take(5)->get();
    }
}
