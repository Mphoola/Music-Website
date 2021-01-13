<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function updateCoverImage($model){
        if (request()->hasFile('cover_image')) {
            $picNameWithExt = request()->file('cover_image')->getClientOriginalName();
            $picName = pathinfo($picNameWithExt, PATHINFO_FILENAME);
            $extension = request()->file('cover_image')->getClientOriginalExtension();
            $picNameToStore = $picName.time().".".$extension;
            request()->file('cover_image')->move(base_path().'/public/Uploads/Cover_images', $picNameToStore);
            
            if(file_exists($model->cover_image)){
                unlink($model->cover_image);
            }

            $model->cover_image = 'Uploads/Cover_images/'. $picNameToStore;

            // this is to resize the image using Intervention Image!
            $image_path = base_path().'/public/Uploads/Cover_images/'. $picNameToStore;
            Image::make($image_path)->resize(1160, 950)->save();

        }
    }

    public static function saveCoverImage(){
        if (request()->hasFile('cover_image')) {
            $picNameWithExt = request()->file('cover_image')->getClientOriginalName();
            $picName = pathinfo($picNameWithExt, PATHINFO_FILENAME);
            $extension = request()->file('cover_image')->getClientOriginalExtension();
            $picNameToStore = $picName.time().".".$extension;
            request()->file('cover_image')->move(base_path().'/public/Uploads/Cover_images', $picNameToStore);
            
            // this is to resize the image using Intervention Image!
            $image_path = base_path().'/public/Uploads/Cover_images/'. $picNameToStore;
            Image::make($image_path)->resize(1160, 950)->save();
        }

       return $picNameToStore;
    }

    public static function checkCategoriesCount(){
        if(Category::count() == 0){
            return redirect()->route('categories.index')
                ->with('error', 'You need to add atleast once beat genre!');
        }
    }

    public static function getFileSize($file_path){
        if(file_exists($file_path)){
            $s = File::size($file_path);
            
            return round($s / 1000000, 2);
        }
    }

    public static function downloadFile($file){
        $loc = public_path().'/'. $file->location;
            
        $file->downloads()->create();
        $file->increment('downloads_count', 1);

        $name = $file->full_details.' - [www.96Legacy.com]'.'.'.$file->extension;
        session()->flash('success', 'Thanks for downloading with 96Legacy. You downloading has started');
        return response()->download($loc, $name);
    }

}
