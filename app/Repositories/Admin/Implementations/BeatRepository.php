<?php 

namespace App\Repositories\Admin\Implementations;

use App\Repositories\Admin\Interfaces\BeatInterface;
use App\Beat;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller as globalMethods;

class BeatRepository implements BeatInterface{

    public function all(){
        return Beat::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
    }

    public function get($id){
        return Beat::findOrFail($id);
    }

    public function store(array $data){
        if($data['beat']){
            $beatNameWithExt = request()->file('beat')->getClientOriginalName();
            $beatName = pathinfo($beatNameWithExt, PATHINFO_FILENAME);
            $beat_extension = request()->file('beat')->getClientOriginalExtension();
            $beatNameToStore = $beatName.time().".".$beat_extension;
            request()->file('beat')->move(base_path().'/public/Uploads/Beats', $beatNameToStore);
        }
        
        // $this->saveCoverImage();

        if($data['market'] == 'free'){
            $amt = 0;
        }else{
            $amt = $data['amount'];
        }
       $beat=  Beat::create([
            'title' => $data['title'],
            'producer' => $data['producer'],
            'category_id' => $data['category_id'],
            'released_date' => $data['released_date'],
            'market' => $data['market'],
            'amount' => $amt,
            'cover_image' => 'Uploads/Cover_images/'. globalMethods::saveCoverImage(),
            'location' => 'Uploads/Beats/'. $beatNameToStore,
            'extension' => $beat_extension,
            'uuid' => (string)\Webpatser\Uuid\Uuid::generate(4),
            'u_name' => Auth::guard('admin')->user()->name
            
        ]);

        return $beat;

    }

    public function update($id, array $data){
        $beat = $this->get($id);

        if(isset($data['beat'])){
            $beatNameWithExt = request()->file('beat')->getClientOriginalName();
            $beatName = pathinfo($beatNameWithExt, PATHINFO_FILENAME);
            $extension = request()->file('beat')->getClientOriginalExtension();
            $beatNameToStore = $beatName.time().".".$extension;
            request()->file('beat')->move(base_path().'/public/Uploads/Beats', $beatNameToStore);

            if(file_exists($beat->location)){
                unlink($beat->location);
            }

            $beat->location = 'Uploads/Beats/'. $beatNameToStore;
            $beat->extension = $extension;
        }
        
        globalMethods::updateCoverImage($beat);
        
        if($data['market'] == 'free'){
            $amt = 0;
        }else{
            $amt = $data['amount'];
        }
      
        $beat->title = $data['title'];
        $beat->producer = $data['producer'];
        $beat->category_id = $data['category_id'];
        $beat->released_date = $data['released_date'];
        $beat->market = $data['market'];
        $beat->amount = $amt;
        $beat->saveOrFail();

        return $beat;

    }
    
    public function delete($id){
        $beat = $this->get($id);
    }
}