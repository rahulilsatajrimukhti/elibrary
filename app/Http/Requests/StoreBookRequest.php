<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id'   => 'required|exists:book_categories,id',
            'author_id'     => 'required|exists:authors,id',
            'publisher_id'  => 'required|exists:publishers,id',
            'title'         => 'required|string|max:255',
            'isbn'          => 'nullable|string|max:100',
            'publish_year'  => 'nullable|digits:4',
            'stock'         => 'required|integer|min:0',
            'cover'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description'   => 'nullable|string',
            'is_active'     => 'required|boolean',
        ];
    }
}
