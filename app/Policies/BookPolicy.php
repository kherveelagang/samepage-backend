<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Book;

class BookPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    
    public function delete(User $user, Book $book)
    {
        return $user->id === $book->owner_id;
    }

    public function update(User $user, Book $book)
    {
        return $user->id === $book->owner_id;
    }
}
