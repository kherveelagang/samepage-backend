<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BorrowedBook;
use Illuminate\Support\Facades\Gate;

class BorrowedBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         // Fetch the book from the database
         $borrowedbook = BorrowedBook::findOrFail($id);
        
         // Check if the user is authorized to update the book
         if (Gate::denies('delete', $borrowedbook)) {
             abort(403, 'Unauthorized');
     }
 
         $borrowedbook->delete();
 
         return response()->json(['message' => 'Request to borrow deleted successfully']);
    }
}
