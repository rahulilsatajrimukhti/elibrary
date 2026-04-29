<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
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
            'name'       => 'required',
            'route'      => 'nullable',
            'icon'       => 'nullable',
            'parent_id'  => 'nullable|exists:menus,id',
            'order'      => 'nullable|integer',
            'is_active'  => 'nullable|boolean',
        ];
    }
}
