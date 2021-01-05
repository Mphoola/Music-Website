<?php 

namespace App\Repositories\Admin\Implementations;

use App\Repositories\Admin\Interfaces\SongInterface;
use App\Song;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller as globalMethods;

class SongRepository implements SongInterface{

    public function all(){
        return Song::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
    }

    public function get($id){
        return Song::findOrFail($id);
    }

    public function store(array $data){
        
        if($data['song']){
            $songNameWithExt = request()->file('song')->getClientOriginalName();
            $songName = pathinfo($songNameWithExt, PATHINFO_FILENAME);
            $song_extension = request()->file('song')->getClientOriginalExtension();
            $songNameToStore = $songName.time().".".$song_extension;
            request()->file('song')->move(base_path().'/public/Uploads/Audios', $songNameToStore);
        }
        
        // $this->saveCoverImage();

        if($data['market'] == 'free'){
            $amt = 0;
        }else{
            $amt = $data['amount'];
        }
       $song=  Song::create([
            'title' => $data['title'],
            'artist' => $data['artist'],
            'producer' => $data['producer'],
            'category_id' => $data['category_id'],
            'released_date' => $data['released_date'],
            'market' => $data['market'],
            'amount' => $amt,
            'cover_image' => 'Uploads/Cover_images/'. globalMethods::saveCoverImage(),
            'location' => 'Uploads/Beats/'. $songNameToStore,
            'extension' => $song_extension,
            'uuid' => (string)\Webpatser\Uuid\Uuid::generate(4),
            'u_name' => Auth::guard('admin')->user()->name
            
        ]);

        return $song;

    }

    public function update($id, array $data){
        $song = $this->get($id);

        if(isset($data['song'])){
            $songNameWithExt = request()->file('song')->getClientOriginalName();
            $songName = pathinfo($songNameWithExt, PATHINFO_FILENAME);
            $extension = request()->file('song')->getClientOriginalExtension();
            $songNameToStore = $songName.time().".".$extension;
            request()->file('song')->move(base_path().'/public/Uploads/Audios', $songNameToStore);

            if(file_exists($song->location)){
                unlink($song->location);
            }

            $song->location = 'Uploads/Audios/'. $songNameToStore;
            $song->extension = $extension;
        }
        
        globalMethods::updateCoverImage($song);
        
        if($data['market'] == 'free'){
            $amt = 0;
        }else{
            $amt = $data['amount'];
        }
      
        $song->title = $data['title'];
        $song->artist = $data['artist'];
        $song->producer = $data['producer'];
        $song->category_id = $data['category_id'];
        $song->released_date = $data['released_date'];
        $song->market = $data['market'];
        $song->amount = $amt;
        $song->saveOrFail();

        return $song;

    }
    
    public function delete($id){
        $song = $this->get($id);
    }
}