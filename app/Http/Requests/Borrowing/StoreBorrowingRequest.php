<?php

namespace App\Http\Requests\Borrowing;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBorrowingRequest extends FormRequest
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

            'book_id' => [
                'required',
                'exists:books,id',
            ],

            'member_id' => [
                'required',
                'exists:users,id',
            ],

            'borrowed_at' => [
                'required',
                'date',
            ],

            'due_date' => [
                'required',
                'date',
                'after_or_equal:borrowed_at',
            ],

            'notes' => [
                'nullable',
                'string',
            ],
        ];
    }
}
