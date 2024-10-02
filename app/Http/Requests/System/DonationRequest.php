<?php

namespace App\Http\Requests\System;

use Illuminate\Foundation\Http\FormRequest;

class DonationRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'giver_user_id' => 'required|exists:users,id',
            'receiver_user_id' => 'required|exists:users,id',
            'campaign_id' => 'required|exists:campaigns,id',
            'transaction_id' => 'nullable|string|max:255',
            'fullname' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'payment_status' => 'required|in:completed,pending',
            'payment_gateway' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
            'service_charge_percentage' => 'required|numeric|min:0|max:100',
            'mobile_number' => 'nullable|string|max:20',
            'payment_receipt' => 'nullable|image|max:10240',
            'address' => 'nullable|string|max:200',
            'description' => 'nullable|string|max:500',
            'donor_display_image' => 'nullable|image|max:10240',
        ];
    }

    /**
     * Get custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'giver_user_id.required' => 'The giver user is required.',
            'receiver_user_id.required' => 'The receiver user is required.',
            'campaign_id.required' => 'The campaign is required.',
            'transaction_id.required' => 'The transaction ID is required.',
            'fullname.required' => 'Full name is required.',
            'country.required' => 'Country is required.',
            'email.required' => 'Email is required.',
            'payment_status.required' => 'Payment status is required.',
            'payment_gateway.required' => 'Payment gateway is required.',
            'amount.required' => 'Donation amount is required.',
            'service_charge_percentage.numeric' => 'Service charge must be a valid percentage.',
            'payment_receipt.file' => 'The payment receipt must be a file.',
        ];
    }
}
