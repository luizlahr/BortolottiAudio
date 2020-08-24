<?php

namespace Borto\Application\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name'   => ['sometimes','required', 'min:4'],
            'email'  => ['sometimes','required', 'email', Rule::unique('users', 'email')->ignore($this->user)->whereNull('deleted_at')],
            'active' => ['sometimes','boolean']
        ];
    }
}
