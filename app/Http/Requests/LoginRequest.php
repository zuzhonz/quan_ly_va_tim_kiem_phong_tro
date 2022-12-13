<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        $rules = [];
        $currentAction = $this->route()->getActionMethod();

        switch ($this->method()):
            case 'POST':
                switch ($currentAction) {
                    case 'postLogin':
                        $rules = [
                            'email' => 'required|email',
                            'password' => 'required',
                            // 'g-recaptcha-response' => 'required|recaptcha'
                        ];
                        break;
                    case 'getCodeForgotPassword':
                        $rules = [
                            'email' => 'required|email',
                            'g-recaptcha-response' => 'required'
                        ];
                        break;
                    case 'postCodeConfirmAcc':
                        $rules = [
                            'code' => 'required'
                        ];
                        break;
                    case 'changePassword':
                        $rules = [
                            'password' => 'required|confirmed',
                            'password_confirmation' => 'required'
                        ];
                        break;
                    default:
                        break;
                }
                break;
            default:
                break;
        endswitch;
        return $rules;
    }

    public function messages()
    {
        return [
            'email.required' => 'Email bắt buộc nhập',
            'email.email' => 'Email chưa đúng định dạng',
            'password.required' => 'Mật khẩu bắt buộc nhập',
            'g-recaptcha-response.required' => 'Bắt buộc xác minh',
            'g-recaptcha-response.recaptcha' => 'Form đăng nhập không dành cho robot',
            'code.required' => 'Mã xác minh bắt buộc nhập',
            'password.confirmed' => 'Xác nhận mật khẩu không chính xác',
            'password_confirmation.required' => 'Xác nhận mật khẩu bắt buộc nhập'
        ];
    }
}
