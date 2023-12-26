<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'books';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'book_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'title',
        'author',
        'ISBN',
        'description',
        'publication_year',
        'image',
        'condition',
        'owner_facebook',
        'owner_instagram',
        'custom_contact_link',
        'owner_id',
        'department_id',
        'status',
    ];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['title', 'author', 'ISBN', 'description', 'publication_year', 'image', 'condition', 'owner_facebook', 'owner_instagram', 'custom_contact_link', 'owner_id', 'department_id', 'status', 'department'];

    
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
