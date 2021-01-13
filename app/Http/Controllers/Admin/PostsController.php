<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogFormRequest;
use App\Post;
use App\Repositories\Admin\Implementations\PostRepository;


class PostsController extends Controller
{
    private $postRepository;

        public function __construct(PostRepository $postRepository)
        {
            $this->postRepository = $postRepository;
        }
    
    public function index()
    {
        $posts = $this->postRepository->all(); 
        return view('management.blog.index', compact('posts'));
    }

    public function create()
    {
        return view('management.blog.create');
    }

    public function store(BlogFormRequest $request)
    {
        $post = $this->postRepository->store($request->all());
        
        if($post){
            session()->flash('success', 'Post created successfully.');
            return redirect(route('blog-posts.index'));
        }else{
            return redirect()->back()->withInput();
        }
    }

    public function show($post)
    {
        $p = Post::findPost($post);
        return view('management.blog.show')->with('post', $p);
    }

    public function edit($id)
    {
        $post  = Post::findPost($id);
        return view('management.blog.create', compact('post'));
    }

    public function update(BlogFormRequest $request, $id)
    {
        $post  = $this->postRepository->update($id, $request->all());

        if($post){
            session()->flash('success', 'Post created successfully.');
            return redirect(route('blog-posts.show', $post->slug));

        }else{
            return redirect()->back()->withInput();
        }
        
    }

    public function destroy($slug)
    {
        return $this->postRepository->delete($slug);
    }

    public function trashed(){
        $post = $this->postRepository->trashed();
        return view('management.blog.index', ['posts' => $post]);
    }

    public function restore($id){
        return $this->postRepository->restore($id);
    }
}
