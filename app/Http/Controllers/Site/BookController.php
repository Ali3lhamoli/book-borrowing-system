<?php

namespace App\Http\Controllers\Site;

use App\Models\Book;
use App\Models\BookBorrowing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class BookController extends Controller
{
    public function getBooksData()
    {
        if (auth()->check()) {
            $books = BookBorrowing::where([
                ['user_id', '=', auth()->user()->id],
                ['status', '!=', 'returned'],
            ])->pluck('book_id');
            $books = Book::query()->whereNotIn('id', $books)->get();
            return DataTables::of($books)
                ->addColumn('availability', function ($book) {
                    return $book->status === 'available' ? 'Available' : 'Unavailable';
                })
                ->addColumn('category', function ($book) {
                    return $book->category ? $book->category->name : 'No Category';
                })
                ->addColumn('image', function ($book) {
                    // هنا يمكننا إرجاع رابط الصورة كـ <img> HTML tag
                    return '<img src="' . get_file_url($book->cover_image) . '" alt="Book Image" width="100">';
                })
                ->addColumn('borrowing', function ($book) {
                    return '<a href="' . route('site.books.borrowing', ['book_id' => $book->id]) . '" class="btn btn-primary"> Borrow </a>';
                })
                ->rawColumns(['image', 'category', 'availability', 'borrowing']) // للسماح بعرض الأعمدة المخصصة
                ->make(true);
        }
        $books = Book::query()->with('category'); // جلب البيانات مع العلاقة
        return DataTables::of($books)
            ->addColumn('availability', function ($book) {
                return $book->status === 'available' ? 'Available' : 'Unavailable';
            })
            ->addColumn('category', function ($book) {
                return $book->category ? $book->category->name : 'No Category';
            })
            ->addColumn('image', function ($book) {
                // هنا يمكننا إرجاع رابط الصورة كـ <img> HTML tag
                return '<img src="' . get_file_url($book->cover_image) . '" alt="Book Image" width="100">';
            })
            ->addColumn('borrowing', function ($book) {
                return '<a href="' . route('site.books.borrowing', ['book_id' => $book->id]) . '" class="btn btn-primary"> Borrow </a>';
            })
            ->rawColumns(['image', 'category', 'availability', 'borrowing']) // للسماح بعرض الأعمدة المخصصة
            ->make(true);
    }

    public function borrowing(Request $request)
    {
        $data = [];
        $data['book_id'] = $request->book_id;
        $data['user_id'] = auth()->user()->id;
        $data['borrow_date'] = date('Y-m-d');
        $data['due_date'] = date('Y-m-d', strtotime('+7 days'));

        BookBorrowing::create($data);
        return redirect()->route('site.books.index');
    }
}
