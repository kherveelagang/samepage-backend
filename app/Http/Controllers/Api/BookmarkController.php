<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Bookmark;
use App\Models\Book;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookmarkRequest;
use Illuminate\Support\Facades\Gate;

class BookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Bookmark::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookmarkRequest $request)
    {
        // Assuming you are using Sanctum for API authentication
        $user = $request->user();

        $validated = $request->validated();

        // Create a bookmark record associated with the authenticated user
        $bookmark = $user->bookmarks()->create($validated);

        return $bookmark;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         // Fetch the book from the database
         $book = Bookmark::findOrFail($id);
        
         // Check if the user is authorized to update the book
         if (Gate::denies('delete', $book)) {
             abort(403, 'Unauthorized');
     }
 
         $book->delete();
 
         return response()->json(['message' => 'Bookmarked book deleted successfully']);
    }
}
