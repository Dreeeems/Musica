<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;

class LogUserRequest extends FormRequest
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
            'email' => 'required|email|exists:users,email',
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
            'email.require' => 'Email not provided',
            'email.email' => 'Invalid emai,',
            'email.exists' => "Email doesn't exist.",
            'password.require' => 'Password not provided.',



        ];
    }
}
