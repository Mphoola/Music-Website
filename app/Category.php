<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug'];

    
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function songs(){
        return $this->hasMany(Song::class);
    }
    public function beats(){
        return $this->hasMany(Beat::class);
    }

    public function videos(){
        return $this->hasMany(Video::class);
    }
}
