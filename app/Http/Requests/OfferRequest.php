<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name_ar'=>'required|max:100|unique:offers',
            'name_en'=>'required|max:100|unique:offers',
            'price'=>'required|numeric',
            'details_ar'=>'required',
            'details_en'=>'required',
//            'photo'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>__('massages.name_is_required'),
            'price.required'=>__('massages.price is required'),
        ];
    }
}
