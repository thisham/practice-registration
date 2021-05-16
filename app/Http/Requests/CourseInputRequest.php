<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseInputRequest extends FormRequest
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
            'code' => 'required',
            'name' => 'required',
            'type' => 'required',
            'curriculum' => 'required',
            'is_active' => ''
        ];
    }
}
