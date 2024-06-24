<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizRequest extends FormRequest
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

        $request = request();

        if ($request->has('Qsm')) {
            $rules = [
                'question' => ['required' , 'string' , 'max:255'],
                'rightAwnser' => ['required' , 'string' , 'max:255'],
                'rate' => ['required' , 'integer'],
                'count' => ['required' , 'integer'],
                'awnser' => ['required' , 'array']
            ];
        }else{
            $rules = [
                'question' => ['required' , 'array'],
            ];
        }      

        return $rules;
    }
}
