<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'isbn',
        'title',
        'stock',
        'publisher',
        'year_published',
        'author',
        'cover_image'
    ];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function getIsAvailableAttribute()
    {
        return $this->stock > 0;
    }

    public function scopeSearch($query, $term)
    {
        return $query->where('title', 'like', "%{$term}%")
            ->orWhere('isbn', 'like', "%{$term}%")
            ->orWhere('author', 'like', "%{$term}%");
    }
}
