<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Models\BookBorrowing;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class BorrowBookController extends Controller
{
    public function index(){

        return view('web.site.pages.borrowing_books');
    }
    public function borrowedBooks(){
        $borrowed_books = BookBorrowing::query()->where([
            ['user_id', '=', auth()->user()->id],
            ['status', '!=', 'returned'],
        ])->with('book');

        return DataTables::of($borrowed_books)
        ->addColumn('title', function ($borrowed_books) {
            return $borrowed_books->book->title ;
        })
        ->addColumn('author', function ($borrowed_books) {
            return $borrowed_books->book->author;
        })
        ->addColumn('image', function ($borrowed_books) {
            return '<img src="' . get_file_url($borrowed_books->book->cover_image) . '" alt="Book Image" width="100">';
        })
        ->rawColumns(['title', 'author', 'image'])
        ->make(true);

    }

}
