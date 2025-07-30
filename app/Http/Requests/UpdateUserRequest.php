<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'role' => 'required|integer|in:1,2,3',
            'device_code' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'login_id' => 'required|string|max:255|unique:users,login_id,' . $this->route('id'),
            'password' => 'nullable|string|min:8|confirmed',
            'password_confirmation' => 'nullable|string',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'role.required' => 'Vui lòng chọn Vai trò!',
            'name.required' => 'Vui lòng nhập Tên người dùng!',
            'login_id.required' => 'Vui lòng nhập Login ID!',
            'login_id.unique' => 'Login ID đã tồn tại!',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự!',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp!',
        ];
    }
}
