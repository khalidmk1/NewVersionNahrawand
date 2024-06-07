<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoUpdateRequest extends FormRequest
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
        $rules = [
            'title' => ['required' , 'string' , 'max:255'],
            'description' => ['required' , 'string' ,'max:255'],
            'image' => ['nullable','file', 'mimes:jpeg,png,jpg,gif' , 'max:2000'],
            'guestIds' => ['nullable' , 'array'],
            'tags' => ['nullable' , 'array'],
            'video' => ['required', 'url', 'regex:/https:\/\/www\.youtube\.com\/watch\?v=/'],
            'duration' => ['nullable']
        ];

        return $rules;
    }
}
