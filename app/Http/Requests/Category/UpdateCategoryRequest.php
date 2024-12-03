<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
        $categoryId = $this->route('category'); // Lấy ID của danh mục từ route.

        return [
            'category_name' => 'required|string|max:255|unique:categories,category_name,' . $categoryId,
            'parent_id'     => 'nullable|exists:categories,id|not_in:' . $categoryId, // Không được chọn chính nó làm cha
            'order'         => 'nullable|integer|min:0',
        ];
    }
}
