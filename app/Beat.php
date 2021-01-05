<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Beat extends Model
{
    use LogsActivity;
    protected static $logAttributes = ['title','user_id', 'u_name', 'amount'];
    protected static $logOnlyDirty = true;

    protected $fillable = 
    [
        'title', 'producer', 'user_id', 'u_name', 'extension',
        'category_id', 'location', 'released_date', 'cover_image', 'market', 'amount', 'uuid'
    ];
    protected $dates = ['released_date'];

    public function getFullDetailsAttribute(){
        return $this->title;
    }
    public function getProducedDateAttribute(){
        return $this->released_date->toFormattedDateString();
    }
 
    public function scopeFindBeat($query, $id){
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
