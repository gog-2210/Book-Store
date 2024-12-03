<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'email_verified_at' => ['nullable', 'date'],
            'phone' => ['nullable', 'string', 'max:15'],
            'address' => ['nullable', 'string', 'max:255'],
            'facebook_id' => ['nullable', 'string', 'max:255'],
            'role' => ['integer', 'in:0,1'],//0 với 1 vì đang chỉ chia 2 role
            'block' => ['nullable', 'boolean'],
        ];
    }

    // public function messages(): array
    // {
    //     return [
    //         // name
    //         'name.required' => 'Họ và tên là bắt buộc.',
    //         'name.string' => 'Họ và tên phải là chuỗi ký tự.',
    //         'name.max' => 'Họ và tên không được vượt quá 255 ký tự.',

    //         // email
    //         'email.required' => 'Email là bắt buộc.',
    //         'email.email' => 'Email phải đúng định dạng.',
    //         'email.unique' => 'Email đã tồn tại trong hệ thống.',

    //         // password
    //         'password.required' => 'Mật khẩu là bắt buộc.',
    //         'password.string' => 'Mật khẩu phải là chuỗi ký tự.',
    //         'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
    //         'password.confirmed' => 'Mật khẩu xác nhận không khớp.',

    //         // phone
    //         'phone.numeric' => 'Số điện thoại phải là số.',
    //         'phone.max' => 'Số điện thoại không được vượt quá 15 ký tự số.',

    //         // address
    //         'address.string' => 'Địa chỉ phải là chuỗi ký tự.',
    //         'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',

    //         // facebook_id
    //         'facebook_id.string' => 'Facebook ID phải là chuỗi ký tự.',
    //         'facebook_id.max' => 'Facebook ID không được vượt quá 255 ký tự.',

    //         // level
    //         'level.required' => 'Cấp độ là bắt buộc.',
    //         'level.integer' => 'Cấp độ phải là một số nguyên.',
    //         'level.in' => 'Cấp độ không hợp lệ. Chỉ được phép là 0 (khách hàng) hoặc 1 (quản trị viên).',

    //         // block
    //         'block.boolean' => 'Giá trị của trạng thái chặn phải là đúng hoặc sai.',
    //     ];
    // }
}
