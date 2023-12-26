<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Book;

class BorrowRequest extends FormRequest
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
        // Additional business logic to ensure borrower is not the owner of the book
        $bookId = $this->input('book_id');
        $userId = $this->input('borrower_id');
        $ownerId = Book::find($bookId)->owner_id;

        return [
            'book_id'           => 'required|integer|exists:books,book_id',
            'return_date'       => 'required|date',
            'canceled_at'       => 'nullable|date',

        ];
    }
}