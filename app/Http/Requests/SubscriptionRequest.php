<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
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
        if ($this->method() === 'POST') {
            return [
                'name' => 'required|string',
                'duration' => 'required|integer|between:0,1000000',
                'price' => 'required|numeric|between:0,1000000',
            ];
        }
        else if ($this->method() === 'PUT'){
            return [
                'name' => 'required|string',
                'duration' => 'required|integer|between:1,1000000',
                'price' => 'required|numeric|between:1,1000000',
            ];
        }
        return [];
    }

    public function messages()
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'name.string' => 'يجب أن يكون الاسم نصياً',
            'duration.required' => 'المدة مطلوبة',
            'duration.integer' => 'يجب أن تكون المدة عدداً صحيحاً',
            'duration.between' => 'يجب أن تكون المدة بين :min و :max',
            'price.required' => 'السعر مطلوب',
            'price.numeric' => 'يجب أن يكون السعر رقماً',
            'price.between' => 'يجب أن يكون السعر بين :min و :max',
            'status.required' => 'الحالة مطلوبة',
            'status.string' => 'يجب أن تكون الحالة نصية',
            'status.in' => 'يجب أن تكون الحالة "active" أو "not_active"',
        ];
    }
}
