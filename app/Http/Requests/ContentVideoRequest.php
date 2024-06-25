<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContentVideoRequest extends FormRequest
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

        $roles = [
            'title' => ['required' , 'string' , 'max:255'],
            'description' => ['required' , 'string' ,'max:255'],
            'image' => ['required', 'file', 'mimes:jpeg,png,jpg,gif' , 'max:2000'],
            'guestIds' => ['nullable' , 'array' ],
            'tags' => ['nullable' , 'array'],
            'video' => ['required', 'url', 'regex:/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/(watch\?v=|embed\/|v\/|.+\/)?([^&=%\?]{11})/i'],
            'duration' => ['nullable']
        ];

        return $roles;
    }
}
