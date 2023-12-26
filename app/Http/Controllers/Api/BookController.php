<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Http\Requests\BookUpdateRequest;
use Illuminate\Support\Facades\Gate;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Book::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        $validated['owner_id'] = auth()->id();

        $book = Book::create($validated);
        
        return $book;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Book::findOrfail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookUpdateRequest $request, string $id)
    {
        // Fetch the book from the database
        $book = Book::findOrFail($id);

        // Check if the user is authorized to update the book
        if (Gate::denies('update', $book)) {
            abort(403, 'Unauthorized');
        }

        $book->owner_id = auth()->id();

        $validated = $request->validated();

        $book->update($validated);

        return response()->json(['message' => 'Book updated successfully', 'data' => $book]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Fetch the book from the database
        $book = Book::findOrFail($id);
        
        // Check if the user is authorized to update the book
        if (Gate::denies('delete', $book)) {
            abort(403, 'Unauthorized');
    }

        $book->delete();

        return response()->json(['message' => 'Book deleted successfully']);
    }
}
