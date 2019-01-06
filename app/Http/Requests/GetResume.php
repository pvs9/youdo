<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetResume extends FormRequest
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
			'filters' => 'required|array',
			'filters.category' => 'numeric|exists:categories,id',
			'filters.reviews' => 'boolean',
			'filters.districts' => 'array',
			'filters.districts.*' => 'numeric|exists:districts,id',
			'filters.prices' => 'array',
			'filters.prices.*' => 'numeric',
			'filters.with_loaders' => 'boolean',
			'filters.is_urgent' => 'boolean',
			'filters.sort' => 'array',
			'filters.sort.*.field' => 'string',
			'filters.sort.*.order' => [
				Rule::in(['asc', 'desc'])
			],
			'filters.experience' => 'numeric',
		];
	}
}
