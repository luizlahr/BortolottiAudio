<?php

namespace Borto\Application\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePersonRequest extends FormRequest
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
            'name'     => ['required', 'min:3'],
            'business' => ['required', 'boolean']
        ];
    }

    public function prepareForValidation()
    {
        $this->merger([
            'business' => (bool) $this->business
        ]);
    }
}
