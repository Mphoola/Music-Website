<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beat extends Model
{

    protected $fillable = 
    [
        'title', 'producer', 'user_id', 'u_name',
        'category_id', 'location', 'released_date', 'cover_image', 'market', 'amount', 'uuid'
    ];

    public function getFullDetailsAttribute(){
        return $this->title;
    }
    public function getProducedDateAttribute(){
        return $this->released_date->toDayDateTimeString();
    }

    protected $dates = ['released_date'];

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
