<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResume extends FormRequest
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
            'experience' => 'required|max:25',
			'is_urgent' => 'boolean',
			'with_loaders' => 'boolean',
			'categories' => 'required|array',
			'categories.*.price' => 'required|numeric',
			'categories.*.id' => 'required|exists:categories,id',
			'is_active' => 'boolean'
        ];
    }
}
