<?php

namespace Modules\ProductStockNowAfter\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStockNowAfterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'available_now' => 'integer|min:0',
            'date_delivery_now' => 'nullable|date',
            'available_after' => 'integer|min:0',
            'date_delivery_after' => 'nullable|date',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
