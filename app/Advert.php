<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Spatie\Activitylog\Traits\LogsActivity;

class Advert extends Model
{
    use LogsActivity;
    protected static $recordEvents = ['deleted', 'created'];
    protected $fillable = [
        'alt',
        'url',
        'image_path',
        'views',
        'clicks',
        'active',
        'advert_category_id'
    ];

    protected $dates = ['viewed_at'];

    public static function make(array $data){
        
        if($data['image']){
            $imageNameWithExt = request()->file('image')->getClientOriginalName();
            $imageName = pathinfo($imageNameWithExt, PATHINFO_FILENAME);
            $image_extension = request()->file('image')->getClientOriginalExtension();
            $imageNameToStore = $imageName.time().".".$image_extension;
            request()->file('image')->move(base_path().'/public/Uploads/Generators', $imageNameToStore);

            $advert_category = AdvertCategory::findOrFail($data['advert_category_id']);
            $image_path = base_path().'/public/Uploads/Generators/'. $imageNameToStore;
            Image::make($image_path)->resize($advert_category->width, $advert_category->height)->save();

        }
        $advert = new Advert;
        $advert->url = $data['url'];
        $advert->alt = $data['alt'];
        $advert->image_path = '/Uploads/Generators/'.$imageNameToStore;
        $advert->advert_category_id = $data['advert_category_id'];
        $advert->saveOrFail();

        return $advert;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query){
        return $query->where('active', true);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function advert_category(){
        return $this->belongsTo(AdvertCategory::class);
    }

    /**
     * @return bool
     */
    public function activate(){
        return $this->update(['active' => true]);
    }

    /**
     * @return bool
     */
    public function deactivate(){
        return $this->update(['active' => false]);
    }

    /**
     * @return bool
     */
    public function plusViews(){
        return DB::table('adverts')
            ->where('id', $this->id)
            ->update(['views' => $this->views+1]);
        
    }

    /**
     * @return bool
     */
    public function plusClicks(){
        return DB::table('adverts')
            ->where('id', $this->id)
            ->update(['clicks' => $this->clicks+1]);
    }

    /**
     * @return bool
     */
    public function resetViews(){
        return DB::table('adverts')
            ->where('id', $this->id)
            ->update(['views' => 0]);
    }

    /**
     * @return bool
     */
    public function resetClicks(){
        return DB::table('adverts')
            ->where('id', $this->id)
            ->update(['clicks' => 0]);
    }

    /**
     * @return bool
     */
    public function updateLastViewed(){      
        return DB::table('adverts')
            ->where('id', $this->id)
            ->update(['viewed_at' => Carbon::now()]);

    }


    public function delete(){
        $this->deleteImage();
        parent::delete();
    }

    /**
     *
     */
    private function deleteImage(){
        $storage = Storage::disk('public');

        if($storage->exists($this->image_path) && $this->image_path !== null){
            $storage->delete($this->image_path);
        }
    }
}
