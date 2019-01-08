<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReview extends FormRequest
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
			'resume_id' => 'required|exists:resumes,id',
			'email' => 'required|email',
			'name' => 'required|string|max:40',
			'text' => 'required|max:200',
			'rating' => 'required|digits_between:1,5',
		];
	}
}
