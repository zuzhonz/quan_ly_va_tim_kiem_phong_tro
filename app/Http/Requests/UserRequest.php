<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        // $rules = [];
        // $currentAction = $this->route()->getActionMethod();//trả về đúng tên hàm
        // // dd($currentAction);
        // switch ($this->method()) {
        //     case 'POST':
        //         switch ($currentAction) {
        //             case 'add':
        //                 $rules = [
        //                     'email'=>'required|unique:users',
        //                     'name'=>'required',
        //                     'password'=>'required',
        //                     'address'=>'required',
        //                     'role_id'=>'required',
        //                     'avt_truoc'=>'required',
        //                     'phone_number'=>'required'
        //                 ];
        //                 break;
        //             default:
        //                 break;
        //         }
        //         break;
            
        //     default:
        //         # code...
        //         break;
        // }
        // return $rules;
        return [];
    }
    // public function messages()
    // {
    //     return [
    //         'email.required' => 'Email bắt buộc nhập',
    //         'email.email' => 'Email chưa đúng định dạng',
    //         'password.required' => 'Mật khẩu bắt buộc nhập',
    //         'name.required' => 'Tên người dùng bắt buộc nhập',
    //         'phone_number.required' => 'Số điện thoại bắt buộc nhập',
    //         'address.required' => 'Địa chỉ bắt buộc nhập',
    //         'role_id.required' => 'Role bắt buộc chọn',
    //         'avt_truoc.required' => 'Avatar bắt buộc bọn'
    //     ];
    // }
}
