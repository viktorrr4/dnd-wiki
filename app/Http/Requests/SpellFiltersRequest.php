<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpellFiltersRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'level' => 'nullable|integer|min:0|max:9',
            'class' => 'nullable|integer|exists:classes,id',
		];
	}
}
