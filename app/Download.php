<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $guarded = [];

    public function downloadable()
    {
        return $this->morphTo();
    }
}
