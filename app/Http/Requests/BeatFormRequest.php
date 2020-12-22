<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BeatFormRequest extends FormRequest
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
        return [
            'title' => 'required',
            'producer' => 'required',
            'category_id' => 'required',
            'released_date' => 'required|date|before:now',
            'cover_image' => 'required|sometimes|image|mimes:jpeg,bmp,png,jpg|max:3000',
            'amount' => 'required_if:market, sale',
            'beat' => 'required|sometimes|mimes:mp3,wav,mpga,audio/mpeg'
        ];
    }
}
