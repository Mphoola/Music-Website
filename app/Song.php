<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = 
    [
        'title', 'artist', 'producer', 'user_id', 'u_name',
        'category_id', 'location', 'released_date', 'cover_image', 'market', 'amount', 'uuid'
    ];

    protected $dates = ['released_date'];

    public function getFullDetailsAttribute(){
        return $this->artist . ' - ' . $this->title;
    }

    public function getProducedDateAttribute(){
        return $this->released_date->toDayDateTimeString();
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function downloads(){
        return $this->morphMany(Download::class, 'downloadable');
    }

    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
