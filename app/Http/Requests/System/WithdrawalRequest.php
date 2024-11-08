<?php

namespace App\Http\Requests\System;

use Illuminate\Foundation\Http\FormRequest;

class WithdrawalRequest extends FormRequest
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
            'campaign_id' => 'required',
            'payment_gateway_id' => 'required',
        ];
        if (authUser()->role->name !== 'public-user') {
            $validation = [
                'campaign_id' => 'required',
                'withdrawal_status' => 'required',
            ];
        }

        return $validation;
    }

    public function messages()
    {
        return [
            'campaign_id.required' => 'The campaign is required. Please select a valid campaign.',
            'payment_gateway_id.required' => 'The payment gateway is required. Please choose a valid payment gateway.',
        ];
    }
}
