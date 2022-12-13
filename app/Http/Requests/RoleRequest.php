<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:6|max:100',
            'desc' => 'required|min:20',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bắt buộc nhập tên quyền !',
            'name.min' => 'Tên lớn hơn 6 ký tự !',
            'name.max' => 'Tên nhỏ hơn 100 ký tự !',
            'name.unique' => 'Tên quyền đã tồnt ại',
            'desc.required' => 'Không để trống mô tả !',
            'desc.min' => 'Mô tả lớn hơn 20 ký tự !',
        ];
    }
}
