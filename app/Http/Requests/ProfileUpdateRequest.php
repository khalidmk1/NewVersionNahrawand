<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'isLogin' => ['boolean'],
            'isPopular' => ['boolean'],
            'password_change' => ['boolean'],
            'isUpdated' => ['boolean'],
            'isDelete' => ['boolean'],
            'biographie' => ['nullable' , 'string' , 'max:300'],
            'facebook' => ['nullable', 'url', 'regex:/facebook.com/'],
            'linkedin' => ['nullable', 'url', 'regex:/linkedin.com/'],
            'instagram' => ['nullable', 'url', 'regex:/instagram.com/'],
            'status_matrimonial' => [ 'string', 'max:255'],
            'numChild' => ['integer'],
            'profission' => [ 'string', 'max:255'],

        ];
    }

}
