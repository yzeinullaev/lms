<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        if ($this->isMethod('PATCH')) {
            $rules = [
                'name' => 'required|min:3|max:255',
                'phone' => 'required|unique:users,phone,' . $this->user,
                'email' => 'unique:users,email,' . $this->user,
            ];

            if (request('password')) {
                $rules['password'] = "sometimes|required|min:6|confirmed";
                $rules['password_confirm'] = "sometimes|required:min:6";
            }
        } elseif ($this->isMethod('get')) {
            $rules = [];
        } else {
            $rules = [
                'name' => 'required|min:3|max:255',
                'phone' => 'required|unique:users',
                'email' => 'unique:users',
                'password' => 'required|string|confirmed|min:6',
            ];
        }

        return $rules;
    }
}
