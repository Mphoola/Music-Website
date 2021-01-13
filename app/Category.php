<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Category extends Model implements Searchable
{
    use LogsActivity;
    protected static $logAttributes = ['name'];
    protected static $logOnlyDirty = true;

    protected $fillable = ['name', 'slug'];

    public function getSearchResult(): SearchResult
    {
        $url = route('frontend.music.showByCategory', $this->slug);

        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }

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
