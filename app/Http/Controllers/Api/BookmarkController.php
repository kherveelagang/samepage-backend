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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Bookmark::findOrfail($id);
    }
}
