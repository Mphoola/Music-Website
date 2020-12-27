<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SongFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =  [
            'title' => 'required',
            'artist' => 'required',
            'producer' => 'required',
            'category_id' => 'required',
            'released_date' => 'required|date|before:now',           
        ];

        if(request()->method() == 'POST'){
            $rules += [
                'song' => 'required|mimes:mp3,wav,mpga,audio/mpeg', 
                'cover_image' => 'required|image|mimes:jpeg,bmp,png,jpg|max:3000'
            ];
        }else{
            $rules += [
                'song' => 'mimes:mp3,wav,mpga,audio/mpeg', 
                'cover_image' => 'image|mimes:jpeg,bmp,png,jpg|max:3000'
            ];
        }

        
        if(request()->market == 'sale'){
            $rules += [
                'amount' => 'required', 
            ];  
        }

        return $rules;
    }
}
