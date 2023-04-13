<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        'name',
        'isbn',
        'country',
        'number_of_pages',
        'publisher',
        'release_date'
    ];

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'author_book');
    }
}
