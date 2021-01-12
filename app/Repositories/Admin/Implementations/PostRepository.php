<?php 

namespace App\Repositories\Admin\Implementations;

use App\Repositories\Admin\Interfaces\PostInterface;
use App\Post;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller as globalMethods;
use Illuminate\Support\Facades\Storage;

class PostRepository implements PostInterface{

    public function all(){
        return Post::orderBy('created_at', 'desc')->paginate(10);
    }

    public function get($id){
        return Post::findOrFail($id);
    }

    public function store(array $data){

        if (request()->hasFile('image')) {
            $picNameWithExt = request()->file('image')->getClientOriginalName();
            $picName = pathinfo($picNameWithExt, PATHINFO_FILENAME);
            $extension = request()->file('image')->getClientOriginalExtension();
            $picNameToStore = $picName.time().".".$extension;
            request()->file('image')->move(base_path().'/public/Uploads/Blog_images', $picNameToStore);
            
        // this is to resize the image using Intervention Image!
        $image_path = base_path().'/public/Uploads/Blog_images/'. $picNameToStore;
        Image::make($image_path)->resize(1160, 950)->save();
        }

        $post = Post::create([
            'title' => $data['title'],
            'slug' => Str::slug($data['title']),
            'description' => $data['description'],
            'content' => $data['content'],
            'published_at' => $data['published_at'],
            'image' => 'Uploads/Blog_images/'. $picNameToStore,
            'author_id' => auth()->guard('admin')->user()->id
        ]);
        return $post;
    }

    public function update($id, array $data){
        $post = Post::findPost($id);

        if (isset($data['image'])) {
            $picNameWithExt = request()->file('image')->getClientOriginalName();
            $picName = pathinfo($picNameWithExt, PATHINFO_FILENAME);
            $extension = request()->file('image')->getClientOriginalExtension();
            $picNameToStore = $picName.time().".".$extension;
            request()->file('image')->move(base_path().'/public/Uploads/Blog_images', $picNameToStore);
            
            $data['image'] = 'Uploads/Blog_images/'. $picNameToStore;
           // this is to resize the image using Intervention Image!
           $image_path = base_path().'/public/Uploads/Blog_images/'. $picNameToStore;
           Image::make($image_path)->resize(1160, 950)->save();

           if(file_exists($post->image)){
            unlink($post->image);
           }
        }

        $post->update($data);

        return $post;

    }
    
    public function delete($slug){
        $post = Post::withTrashed()->findPost($slug);
        if($post->trashed()){
            $post->forceDelete();
            if(file_exists($post->image)){

                Storage::delete($post->image);
            }
            session()->flash('success', 'Post Deleted permanently successfully.');
            return redirect(route('blog-posts.trashed'));
        }else{
            $post->delete();
            session()->flash('success', 'Post Trahed successfully.');
            return redirect(route('blog-posts.index'));
        }
    }

    public function trashed(){
        return Post::onlyTrashed()->orderByDesc('deleted_at')->simplePaginate(10);
    }

    public function restore($id){
        $post = Post::onlyTrashed()->findPost($id);
        $post->restore();
        session()->flash('success', 'Post Restored successfully.');
        return redirect(route('blog-posts.index'));
    }
}