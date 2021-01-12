<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class AdvertCategory extends Model
{
    use LogsActivity;
    protected $fillable = ['type', 'width', 'height'];

    public function adverts(){
        return $this->hasMany(Advert::class);
    }
}
