<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Borrow;
use App\Models\Book;
use App\Http\Controllers\Controller;
use App\Http\Requests\BorrowRequest;
use Illuminate\Support\Facades\Gate;


class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Borrow::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BorrowRequest $request)
    {
       // Retrieve the validated input data
       $validated = $request->validated();

       $book = Book::findOrFail($validated['book_id']);

       if ($book->owner_id == auth()->id()) {
        return response()->json(['message' => 'You cannot borrow your own book.'], 403);
    }

        $validated['borrower_id'] = auth()->id();

        $borrow = Borrow::create($validated);

       return $borrow;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Borrow::findOrfail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bookRequest = Borrow::findOrFail($id);

        // Validate and handle approval/decline logic

        return $bookRequest;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Fetch the book from the database
        $borrow = Borrow::findOrFail($id);
        
        // Check if the user is authorized to update the book
        if (Gate::denies('delete', $borrow)) {
            abort(403, 'Unauthorized');
    }

        $borrow->delete();

        return response()->json(['message' => 'Request to borrow deleted successfully']);
    }
}
