<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Unique;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', new Unique('users', 'email')],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function name(): string
    {
        return $this->input('name');
    }

    public function email(): string
    {
        return $this->input('email');
    }

    public function password(): string
    {
        return $this->input('password');
    }
}
