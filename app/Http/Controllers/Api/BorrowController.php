<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Borrow;
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
        $validated = $request->validated();

        $borrow = Borrow::create($validated);

        // Notify the owner or handle notifications as needed

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
