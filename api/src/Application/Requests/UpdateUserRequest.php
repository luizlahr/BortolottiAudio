<?php

namespace Borto\Application\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name'=> ['sometimes','required', 'min:4'],
            'email'=> ['sometimes','required', 'email', Rule::unique('users', 'email')->ignore($this->user)],
            'active' => ['sometimes','boolean']
        ];
    }
}
