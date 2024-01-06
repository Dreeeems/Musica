<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreatePostRequest extends FormRequest
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
        return [
            //
            'title' => 'required'
        ];
    }

    public function failedValidation(ValidationValidator $validator)
    {

        throw new HttpResponseException(response()->json([
            'succes' => false,
            "error" => true,
            'message' => 'Validation failed',
            'errorsList' => $validator->errors()
        ]));
    }

    public function messages()
    {

        return [
            'title.required' => 'No title'
        ];
    }
}
