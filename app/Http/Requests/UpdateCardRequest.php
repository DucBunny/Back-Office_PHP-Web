<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCardRequest extends FormRequest
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
            'is_cut' => 'required|boolean',
            'is_perm' => 'required|boolean',
            'perm_note' => 'nullable|string|max:200',
            'is_color' => 'required|boolean',
            'color_note' => 'nullable|string|max:200',
            'practitioner' => 'required|string|max:255',
            'memo' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Get the custom messages for the validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'perm_note.max' => 'Ghi chú uốn tóc không được vượt quá 200 ký tự!',
            'color_note.max' => 'Ghi chú nhuộm tóc không được vượt quá 200 ký tự!',
            'practitioner.required' => 'Vui lòng nhập Người thực hiện!',
            'memo.max' => 'Ghi chú không được vượt quá 1000 ký tự!',
        ];
    }
}
