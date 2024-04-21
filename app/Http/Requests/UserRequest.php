<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
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
        $request = [
            'name' => ['required', 'min:3', 'max:50'],
            'email' => ['required', 'email', 'min:10', 'max:50'],
            'role' => ['required']
        ];

        if (request('type') == 'create') {
            array_push($request['email'], Rule::unique('users'));
            $request = array_merge($request, ['password' => [
                'required',
                Password::min(8),
                Password::min(8)->letters(),
                Password::min(8)->mixedCase(),
                Password::min(8)->numbers(),
                Password::min(8)->symbols()
            ]]);
        } else {
            array_push($request['email'], Rule::unique('users')->ignore($this->user->id));
        }

        return $request;
    }

    public function messages(): array
    {
        return [
            'password.regex:/[@$!%*#?&]/' => 'Password must contain at least 1 unique character'
        ];
    }
}
