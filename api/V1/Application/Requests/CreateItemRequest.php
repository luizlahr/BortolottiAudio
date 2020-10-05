<?php

namespace Borto\Application\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateItemRequest extends FormRequest
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
            "order_id" => ['required', 'exists:order,id'],
            "type"     => ["required","in:{OrderItem::TYPE_SALE},{OrderItem::TYPE_MAINTENANCE}"],
            "name"     => ["required_if:type,{OrderItem::TYPE_SALE}"],
            "amount"   => ["required_if:type,{OrderItem::TYPE_SALE}","numeric",'min:1'],
            "measure"  => ["required_if:type,{OrderItem::TYPE_SALE}"],
            "model_id" => ["required_if:type,{OrderItem::TYPE_MAINTENANCE}"],
            "value"    => ['numeric','min:0'],
        ];
    }
}
