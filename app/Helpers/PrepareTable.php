<?php

use Yajra\DataTables\Facades\DataTables;
use App\Models\User;

function prepareBooksDataTable($books)
{
    return DataTables::of($books)
        ->addColumn('availability', function ($book) {
            return $book->status === 'available' ? 'Available' : 'Unavailable';
        })
        ->addColumn('category', function ($book) {
            return $book->category ? $book->category->name : 'No Category';
        })
        ->addColumn('image', function ($book) {
            return '<img src="' . get_file_url($book->cover_image) . '" alt="Book Image" width="100">';
        })
        ->addColumn('borrowing', function ($book) {
            return $book->status === 'available' ? 
                '<a href="' . route('site.books.borrowing', ['book_id' => $book->id]) . '" class="btn btn-primary"> Borrow </a>' 
                : 'Unavailable Now';
        })
        ->addColumn('admin', function ($book) {
            // تحقق من دور المستخدم
            if (auth()->check() && auth()->user()->hasRole('admin')) {
                return '
                    <a href="' . route('site.books.edit', [ $book->id]) . '" class="btn btn-warning m-2"> Edit </a>
                    <form action="' . route('site.books.destroy',  [$book->id]) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger"> Delete </button>
                    </form>
                ';
            }
            return ''; // العمود يكون فارغًا إذا لم يكن المستخدم أدمن
        })
        ->rawColumns(['image', 'category', 'availability', 'borrowing', 'admin'])
        ->make(true);
}
