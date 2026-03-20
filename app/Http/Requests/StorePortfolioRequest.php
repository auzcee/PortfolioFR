<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePortfolioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:portfolios,slug'],
            'description' => ['nullable', 'string', 'max:1000'],
            'status' => ['required', 'in:draft,published,rejected'],
            'images' => ['nullable', 'json'],
        ];
    }
}
