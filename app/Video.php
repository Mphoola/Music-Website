<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Str;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Video extends Model implements Searchable
{
    use LogsActivity;
    protected static $logAttributes = ['title','user_id', 'u_name','amount'];
    protected static $logOnlyDirty = true;
    
    protected $fillable = 
    [
        'title', 'artist', 'producer', 'user_id', 'u_name','extension',
        'category_id', 'location', 'released_date', 'cover_image', 'market', 'amount', 'uuid'
    ];
    protected $dates = ['released_date'];

    public function getSearchResult(): SearchResult
    {
        if(Auth::guard('admin')->check()){
            $url = route('videos.show', $this->id);
        }else{

            $url = route('frontend.videos.show', ['f' => $this->slug, 'id' => $this->uuid]);
        }

        return new SearchResult(
            $this,
            $this->full_details,
            $url
        );
    }

    public function getFullDetailsAttribute(){
        return $this->artist . ' - ' . $this->title;
    }

    public function getSlugAttribute(){
        return Str::slug($this->full_details);
    }

    public function getProducedDateAttribute(){
        return $this->released_date->toFormattedDateString();
    }

    public function scopeFindVideo($query, $id){
        return $query->where('uuid', $id)->firstOrFail();
    }
    
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function downloads(){
        return $this->morphMany(Download::class, 'downloadable');
    }

    public function comments(){
        return $this->morphMany(Comment::class, 'commentable')->orderBy('created_at', 'desc');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
