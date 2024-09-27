<?php

namespace App\Http\Requests\System;

use Illuminate\Foundation\Http\FormRequest;

class CampaignRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'slug' => 'required|max:300|unique:campaign_categories,slug,' . $this->id,
            'user_id' => 'required|exists:users,id',
            'description' => 'required|string|max:10000',
            'start_date' => 'required|date|after:yesterday',
            'end_date' => 'required|date|after:start_date',
            'goal_amount' => 'required|numeric|min:0',
            'country' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'campaign_status' => 'required',
            'campaign_category_id' => 'required|exists:campaign_categories,id',
            'is_featured' => 'nullable|boolean',
            'image' => 'nullable|image|max:10240',
            'status' => 'nullable|boolean',
        ];
        return $validation;
    }
    public function messages()
    {
        return [
            'user_id.required' => 'The campaign owner is required to create a campaign.',
            'user_id.exists' => 'The selected campaign owner does not exist in our records.',
            'campaign_category_id.required' => 'Please select a campaign category.',
            'campaign_category_id.exists' => 'The selected campaign category is invalid.',
        ];
    }
}
