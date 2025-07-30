<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalonRequest extends FormRequest
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
            'salon_code' => 'required|string|max:10|unique:salons,salon_code,' . $this->route('id'),
            'type' => 'required|in:1,2',
            'name' => 'required|string|max:255',
            'furigana' => 'required|string|max:255',
            'color_plus_point' => 'required|integer|min:0',
            'perm_plus_point' => 'required|integer|min:0',
            'address' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get the custom validation messages for the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'salon_code.max' => 'Mã cửa hàng không được vượt quá 10 ký tự!',
            'salon_code.unique' => 'Mã cửa hàng đã tồn tại!',
            'salon_code.required' => 'Vui lòng nhập Mã cửa hàng!',
            'type.required' => 'Vui lòng chọn Loại cửa hàng!',
            'name.required' => 'Vui lòng nhập Tên cửa hàng!',
            'furigana.required' => 'Vui lòng nhập Furigana!',
        ];
    }
}
