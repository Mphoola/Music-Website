<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['creator_name', 'creator_email','content','commentable_id','commentable_type'];

    public function commentable()
    {
        return $this->morphTo();
    }
}
