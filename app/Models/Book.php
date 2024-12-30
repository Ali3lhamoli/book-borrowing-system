<?php

namespace App\Models;

use App\Models\Category;
use App\Models\BookBorrowing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'author',
        'cover_image',
        'isbn',
        'description',
        'category_id',
        'quantity',
        'available_quantity',
        'status',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function bookBorrowing(){
        return $this->hasMany(BookBorrowing::class);
    }
}
