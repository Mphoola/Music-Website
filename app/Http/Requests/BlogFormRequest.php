<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogFormRequest extends FormRequest
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
        $promise = [
            'description' => 'required',
            'content' => 'required',
            'published_at' => 'required|after_or_equal:today',
        ];

        if(request()->method() == 'POST'){
            $promise += [
                'title' => 'required|unique:posts',
                'image' => 'required|image|mimes:jpeg,bmp,png,jpg|max:3000'
            ];
        }else{
            $promise += [
                'title' => 'required',
                'image' => 'image|mimes:jpeg,bmp,png,jpg|max:3000'
            ];
        }

        return $promise;
    }
}
