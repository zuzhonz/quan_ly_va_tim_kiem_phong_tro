<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlansRequest extends FormRequest
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
            'priority_level' => 'required|not_in: 0',
            'type' => 'required|not_in:0',
            'time' => 'required|max:11',
            'price' => 'required|max:8',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bắt buộc nhập tên gói !',
            'name.min' => 'Tên lớn hơn 6 ký tự !',
            'name.max' => 'Tên nhỏ hơn 100 ký tự !',
            'desc.required' => 'Không để trống mô tả !',
            'desc.min' => 'Mô tả lớn hơn 20 ký tự !',
            'priority_level.not_in' => 'Chưa chọn mức độ ưu tiên !',
            'type.not_in' => 'Chưa chọn loại cho dịch vụ !',
            'time.required' => 'Không để trống thời hạn !',
            'time.max' => 'nhập quá quá giới hạn tối đa của gói !',

            'price.required' => 'Không để trống giá của gói !',
            'price.max' => 'nhập quá số trị giá của gói !',
        ];
    }
}