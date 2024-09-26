<?php

namespace App\Http\Requests\System;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
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
            'message' => 'required|string|max:500',
            'position' => 'required|numeric',
            'designation' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|max:10240', // Max 2MB
            'status' => 'required|boolean',
        ];
        return $validation;
    }
}
