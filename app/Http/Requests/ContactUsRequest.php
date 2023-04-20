<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
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
            'name' => ['required'],
            'email' => ['nullable', 'email'],
            'phone' => ['required', 'max:25'],
            'subject' => ['nullable'],
            'message' => ['nullable', 'min:10'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The Name field is required',
            'email.email' => 'The Email is not valid',
            'phone.max' => 'The maximum length is 25',
            'message.min' => 'The minimum length is 10',
        ];
    }
}
