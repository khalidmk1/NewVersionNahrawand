<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContentRequest extends FormRequest
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
            'smallDescription' => ['required' , 'string' , 'max:300'],
            'tags' => ['array'],
            'cotegoryId' => ['required'],
            'objectivesId' => ['nullable' , 'array'],
            'subCategoryId' => ['nullable' , 'array'],
            'contentType' => ['required', 'in:conference,podcast,formation'],
            'contentHost' => ['required'],
            'contentImage' => ['required' , 'file' ,'mimes:jpeg,png,jpg,gif' ,'max:2000'],
            'contentImageFlex' => ['required' , 'file' ,'mimes:jpeg,png,jpg,gif' ,'max:2000'],
            'condition' => ['nullable' , 'string'],
            'isCertify' => ['nullable' , 'boolean'],
            'programId' => ['nullable'],
            'document' => ['nullable' , 'file' ,'mimes:pdf' ,'max:2000'],
        ];

        if ($this->contentType === 'conference' || $this->contentType === 'podcast') {
            $rules['bigDescription'] = ['required', 'string', 'max:600'];
            $rules['videoUrl'] = ['required' , 'url'];
            $rules['duration'] = ['required'];

        }


        return $rules;
    }
}
