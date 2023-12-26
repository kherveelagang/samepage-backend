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
            'borrower_id' => 'required|integer|exists:users,id',
            'book_id' => 'required|integer|exists:books,book_id',
            'status' => 'required|in:pending,accepted,declined',
            'return_date' => 'nullable|date',
            'canceled_at' => 'nullable|date',
            'book_owner_check' => [
                'required',
                function ($attribute, $value, $fail) use ($userId, $ownerId) {
                    if ($userId === $ownerId) {
                        $fail('The borrower cannot be the owner of the book.');
                    }
                },
            ],
        ];
    }
}