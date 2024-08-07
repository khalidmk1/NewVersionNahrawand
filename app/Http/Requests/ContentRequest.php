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

    protected function prepareForValidation()
    {
        if ($this->has('document')) {
            $this->merge([
                'document' => $this->cleanGoogleDriveUrl($this->document),
            ]);
        }
    }

    protected function cleanGoogleDriveUrl($url)
    {
        if (preg_match('/^(https:\/\/drive\.google\.com\/file\/d\/[a-zA-Z0-9_-]+)\/?.*$/', $url, $matches)) {
            return $matches[1];
        }
        return $url;
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
            'tags' => ['array'],
            'cotegoryId' => ['required'],
            'objectivesId' => ['nullable' , 'array'],
            'subCategoryId' => ['nullable' , 'array'],
            'contentType' => ['required', 'in:conference,podcast,formation,quickly'],
            'contentHost' => ['required'],
            'contentImage' => ['required' , 'file' ,'mimes:jpeg,png,jpg,gif' ,'max:2000'],
            'contentImageFlex' => ['required' , 'file' ,'mimes:jpeg,png,jpg,gif' ,'max:2000'],
            'condition' => ['nullable' , 'string'],
            'isCertify' => ['nullable'],
            'programId' => ['nullable'],
            'document' => ['nullable', 'url', 'regex:/^https:\/\/drive\.google\.com\/file\/d\/[a-zA-Z0-9_-]+$/'],
        ];

        if ($this->contentType === 'conference' || $this->contentType === 'podcast') {
            $rules['smallDescription'] = ['required' , 'string' , 'max:300'];
            $rules['bigDescription'] = ['required', 'string', 'max:600'];
            $rules['videoUrl'] = ['required' , 'url' , 'regex:/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/(watch\?v=|embed\/|v\/|.+\/)?([^&=%\?]{11})/i'];
            $rules['duration'] = ['required'];

        }


        return $rules;
    }
}
