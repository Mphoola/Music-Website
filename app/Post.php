<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Post extends Model
{
    use SoftDeletes, LogsActivity;
    protected static $logAttributes = ['title','description','author_id'];
    protected static $logOnlyDirty = true;
    
    protected $fillable = ['title', 'slug', 'description', 'content', 
    'published_at','image','author_id'];

    protected $dates = ['published_at'];

    public function getPublishedDateAttribute(){
        return $this->published_at->toFormattedDateString();
    }

    public function scopeFindPost($query, $slug){
        return $query->where('slug', $slug)->firstOrFail();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function author(){
        return $this->belongsTo(Admin::class, 'author_id');
    }

    public function comments(){
        return $this->morphMany(Comment::class, 'commentable')->orderBy('created_at', 'desc');
    }

    public function scopeSearched($query){
        $search = request()->query('search');

        if(!$search){
            return $query;
        }
        return Post::where('title', 'LIKE', "%{$search}%");
    }
}
