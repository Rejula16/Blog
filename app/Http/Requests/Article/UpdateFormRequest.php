<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFormRequest extends FormRequest
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

            'title' => 'required|max:50|unique:articles',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id'
           
        ];
    }
    public function messages()
    {
        return [
         'title.required'=>'Please enter Article title',
         'title.max'=>'You can not enter more than 50 characters',
         'body.required' => 'Please enter Article body',
        ];
    }
}
