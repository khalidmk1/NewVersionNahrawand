<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MapUpdateRequest extends FormRequest
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
            'country' => ['sometimes' , 'string' ,'max:255'],
            'slogan' => ['required' , 'string' , 'max:255'],
            'imagePrincipale' => ['sometimes', 'file', 'mimes:jpeg,png,jpg,gif' , 'max:2000'],
            'images' => ['nullable' , 'array'],
            'imagesPlaces' => ['nullable' , 'array'],
            'dateEstablishe' => ['required' , 'string' , 'date'],
            'founder' => ['required' , 'string' , 'max:255'],
            'description' => ['required' , 'string' , 'max:300'],
            'plateImages' => ['nullable' , 'array'],
            'clotheImages' => ['nullable' , 'array'],
            'textClothes' => ['array'],
            'placeImages' => ['nullable' , 'array'],
            'textPlate' => ['nullable' , 'array'],
            'titlePlace' => ['nullable' , 'array'],
            'descriptionPlace' => ['nullable' , 'array'],
            'adressePlace' => ['nullable' , 'array'],
            'linkPlace' => ['nullable' , 'array'],
        ];

        return $rules;
    }
}
