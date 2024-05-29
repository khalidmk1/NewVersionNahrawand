<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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

        $rule = [
            'title' => ['required' , 'string' ,'max:255'],
            'description' => ['required' , 'string' ,'max:300'],
            'speakerID' => ['nullable' , 'array'],
            'datestart' => ['required' , 'date'],
            'DateEnd' => ['required' , 'date'],
            'image' => ['required' , 'file' ,'mimes:jpeg,png,jpg,gif' ,'max:2000'],
            'url' => ['required' , 'url']
        ];

        return $rule;
    }
}
