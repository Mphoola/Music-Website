<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function saveCoverImage($model){
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

}
