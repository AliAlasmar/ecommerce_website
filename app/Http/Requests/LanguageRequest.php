<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
            'name'=>'required|string|max:100',
            'abbr'=>'required|string|max:100',


        ];

    }

    public function messages()
    {
        return [
            'required'=>'  هذا الحقل مطلوب',
            'name.string'=>'  111111111111',

            'max'=> 'الاسم لا يجب ان يتجازو 100'
        ];

    }
}
