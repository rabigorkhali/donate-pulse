<?php

namespace App\Http\Requests\System;

use Illuminate\Foundation\Http\FormRequest;

class CampaignCategoryRequest extends FormRequest
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'slug' => 'required|max:300|unique:campaign_categories,slug,'.$this->id,
            'status' => 'nullable|boolean',
        ];
        return $validation;
    }
}
