<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'book_id'               =>  'integer',
            'title'                 =>  'string|max:255',
            'author'                =>  'string|max:255',
            'ISBN'                  =>  'required|string|max:13|unique:App\Models\Book,ISBN|regex:/^\d{13}$/',
            'description'           =>  'string|max:255',
            'publication_year'      =>  'required|integer',
            'image'                 =>  'string|nullable|max:255',
            'condition'             =>  'string|max:255',
            'owner_facebook'        =>  'string|nullable|max:255',
            'owner_instagram'       =>  'string|nullable|max:255',
            'custom_contact_link'   =>  'string|nullable|max:255',
            'department_id'         =>  'required|integer',
            'status'                =>  'nullable|in:available,unavailable',
        ];
    }
}
