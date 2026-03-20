<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePortfolioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $portfolioId = $this->route('id');

        return [
            'title' => ['sometimes', 'string', 'max:255'],
            'slug' => ['sometimes', 'string', 'max:255', "unique:portfolios,slug,{$portfolioId}"],
            'description' => ['nullable', 'string', 'max:1000'],
            'status' => ['sometimes', 'in:draft,published,rejected'],
            'images' => ['nullable', 'json'],
        ];
    }
}
