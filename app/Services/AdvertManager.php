<?php
namespace App\Services;

use App\AdvertCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\HtmlString;

class AdvertManager {

    /**
     * @var array
     */
    private $used = [];

    /**
     * @var object;
     */
    private static $instance;

    /**
     * @return AdvertManager
     */
    public static function getInstance()
    {
        return static::$instance ?: (static::$instance = new self());
    }


    /**
     * Search advert by AdvertCategory type
     * If duplicate set to true then it's possible that advert will be the same with
     * previous showed advert
     *
     * @param $type
     * @param bool $duplicate
     * @return HtmlString|string
     */
    public function displayAdvert($type,  $duplicate = false){
        $advert_category = AdvertCategory::where('type', $type)->first();
        if(!$advert_category){
            return '';
        }

        $advert = DB::table('adverts')
            ->where('advert_category_id', $advert_category->id)
            ->where('active', true)
            ->where(function($query) use ($duplicate){
                if(!$duplicate){
                    $query->whereNotIn('id', $this->used);
                }
            })
            ->orderBy('viewed_at', 'ASC')
            ->first();

        if($advert){
            DB::table('adverts')
                ->where('id', $advert->id)
                ->update(['viewed_at' => Carbon::now()]);

            DB::table('adverts')
                ->where('id', $advert->id)
                ->update(['views' => $advert->views+1]);
           
            $this->used[$type][] = $advert->id;
            $html = View::make('partials.advert', compact('advert'))->render();
            return new HtmlString($html);
        } else {
            return '';
        }
    }

}