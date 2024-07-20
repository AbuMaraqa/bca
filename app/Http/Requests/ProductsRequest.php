<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'required|numeric|min:0',
            'category_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'حقل اسم المنتج مطلوب .',
            'price.required'=> 'حقل سعر المنتج مطلوب .',
            'price.numeric'=> 'يجب ان يكون سعر المنتج عبارة عن ارقام فقط .',
            'price.min'=> 'يجب ان يكون سعر المنتج اعلى من صفر .',
            'cost_price.required'=> 'حقل سعر تكلفة المنتج مطلوب .',
            'cost_price.numeric'=> 'يجب ان يكون سعر تكلفة المنتج عبارة عن ارقام فقط .',
            'cost_price.min'=> 'يجب ان يكون سعر تكلفة المنتج اعلى من صفر .',
            'category_id.required'=>'حقل التصنيف مطلوب'
        ];
    }
}
