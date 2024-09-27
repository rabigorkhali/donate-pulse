<?php

namespace App\Http\Requests\System;

use Illuminate\Foundation\Http\FormRequest;

class PaymentGatewayRequest extends FormRequest
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
        $validation = [
            'user_id' => 'required|exists:users,id',
            'payment_gateway' => 'required|in:bank,esewa,khalti',
            'mobile_number' => 'required|min:10|max:10',

            // Bank details validation (only if payment_gateway is 'bank')
            'bank_name' => 'required_if:payment_gateway,bank|string|max:255',
            'bank_account_name' => 'required_if:payment_gateway,bank|string|max:255',
            'bank_swift_code' => 'required_if:payment_gateway,bank|string|max:255',
            'bank_address' => 'required_if:payment_gateway,bank|string|max:255',
            'bank_account_number' => 'required_if:payment_gateway,bank|string|max:255',
        ];
        return $validation;
    }
}
