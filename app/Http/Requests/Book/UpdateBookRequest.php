<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
    public function rules()
    {
        return [
            'book_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'publish_date' => 'nullable|date',
            'author' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'category_id' => 'required|exists:categories,id',
            'number_of_pages' => 'nullable|integer|min:1',
            'price' => 'nullable|numeric|min:0',
            'cover_price' => 'nullable|numeric|min:0',
            'book_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

}
