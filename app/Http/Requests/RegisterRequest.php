<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'phone' => 'required|unique:users,phone',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'email.unique' => 'Логин существует',
            'phone.unique' => 'Номер существует',
        ];
    }

    /**
     * @param Validator $validator
     * @return array
     */
    protected function failedValidation(Validator $validator): array
    {
        throw new HttpResponseException(response()->json(
            [
                'success' => false,
                'message' => 'Ошибка',
                'status' => 422,
                'error' => $validator->errors(),
                'data' => [],
            ], 422)
        );
    }
}
