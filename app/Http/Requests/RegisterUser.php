<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;

class RegisterUser extends FormRequest
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
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required'

        ];
    }

    public function failedValidation(ValidationValidator $validator)
    {

        throw new HttpResponseException(response()->json([
            'succes' => false,
            'status_code' => 422,
            "error" => true,
            'message' => 'Validation failed',
            'errorsList' => $validator->errors()
        ]));
    }

    public function messages()
    {

        return [
            'name.required' => 'No username',
            'email.required' => 'No email',
            'email.unique' => 'No unique email',
            'password.require' => 'Password required'


        ];
    }
}
