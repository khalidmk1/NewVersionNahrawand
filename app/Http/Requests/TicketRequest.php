<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            'clientId' => ['required'],
            'managerId' => ['required'],
            'TypeTicket' => ['required' , 'string' , 'max:255'],
            'status' => ['required' , 'boolean'],
            'detail' => ['required' , 'string' , 'max:600'],
            'file' => ['required' , 'file' , 'mimes:png,jpeg,jpg' ,'max:2000']
        ];

        return  $rules;
    }
}
