<?php

namespace App\Http\Requests\System;

use Illuminate\Foundation\Http\FormRequest;

class PartnerRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'image' => 'required|image|max:10240',
            'website' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'position' => 'nullable|integer|min:0',
            'status' => 'required|integer',
        ];
        if ($this->method() == 'PUT') {
            $validation['image'] = 'nullable|image|max:10240';
        }
        return $validation;
    }
}
