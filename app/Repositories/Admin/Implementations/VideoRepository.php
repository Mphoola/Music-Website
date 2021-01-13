<?php 

namespace App\Repositories\Admin\Implementations;

use App\Repositories\Admin\Interfaces\VideoInterface;
use App\Video;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller as globalMethods;

class VideoRepository implements VideoInterface{

    public function all(){
        return Video::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
    }

    public function get($id){
        return Video::findOrFail($id);
    }

    public function store(array $data){
        
        if($data['video']){
            $videoNameWithExt = request()->file('video')->getClientOriginalName();
            $videoName = pathinfo($videoNameWithExt, PATHINFO_FILENAME);
            $video_extension = request()->file('video')->getClientOriginalExtension();
            $videoNameToStore = $videoName.time().".".$video_extension;
            request()->file('video')->move(base_path().'/public/Uploads/Videos', $videoNameToStore);
        }
        
        // $this->saveCoverImage();

        if($data['market'] == 'free'){
            $amt = 0;
        }else{
            $amt = $data['amount'];
        }
       $video=  Video::create([
            'title' => $data['title'],
            'artist' => $data['artist'],
            'producer' => $data['producer'],
            'category_id' => $data['category_id'],
            'released_date' => $data['released_date'],
            'market' => $data['market'],
            'amount' => $amt,
            'cover_image' => 'Uploads/Cover_images/'. globalMethods::saveCoverImage(),
            'location' => 'Uploads/Beats/'. $videoNameToStore,
            'extension' => $video_extension,
            'uuid' => (string)\Webpatser\Uuid\Uuid::generate(4),
            'admin_id' => Auth::guard('admin')->user()->id
            
        ]);

        return $video;

    }

    public function update($id, array $data){
        $video = $this->get($id);

        if(isset($data['video'])){
            $videoNameWithExt = request()->file('video')->getClientOriginalName();
            $videoName = pathinfo($videoNameWithExt, PATHINFO_FILENAME);
            $extension = request()->file('video')->getClientOriginalExtension();
            $videoNameToStore = $videoName.time().".".$extension;
            request()->file('video')->move(base_path().'/public/Uploads/Videos', $videoNameToStore);

            if(file_exists($video->location)){
                unlink($video->location);
            }

            $video->location = 'Uploads/Videos/'. $videoNameToStore;
            $video->extension = $extension;
        }
        
        globalMethods::updateCoverImage($video);
        
        if($data['market'] == 'free'){
            $amt = 0;
        }else{
            $amt = $data['amount'];
        }
      
        $video->title = $data['title'];
        $video->artist = $data['artist'];
        $video->producer = $data['producer'];
        $video->category_id = $data['category_id'];
        $video->released_date = $data['released_date'];
        $video->market = $data['market'];
        $video->amount = $amt;
        $video->saveOrFail();

        return $video;

    }
    
    public function delete($id){
        $video = $this->get($id);
    }
}