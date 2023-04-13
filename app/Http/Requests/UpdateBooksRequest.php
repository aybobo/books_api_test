<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBooksRequest extends FormRequest
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
            'name' => 'nullable|string',
            // 'isbn' => 'nullable|string|unique:books',       
            'authors'   => 'nullable|array',
            'authors.*' => 'integer',
            'country' => 'nullable|string',
            'number_of_pages' => 'nullable|integer',
            'publisher' => 'nullable|string',
            'release_date' => 'nullable|date'
        ];
    }
}
