<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordChangeRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            "oldpassword" => "required",
            "newpassword" => "required|min:8|confirmed"
        ];
    }

    public function messages()
    {
        return [
            'newpassword.required' => 'Password wajib diisi.',
            'newpassword.min' => 'Password setidaknya berisi 8 karakter atau lebih.',
            'newpasswword.confirmed' => 'Password harus dikonfirmasi dengan benar.'
        ];
    }
}
