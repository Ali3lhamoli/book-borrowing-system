<?php

namespace App\Http\Controllers\Site;

use App\Models\Book;
use App\Models\BookBorrowing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
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
            return prepareBooksDataTable($books);
        }
        $books = Book::query()->with('category');
        return prepareBooksDataTable($books);
    }

    public function borrowing(Request $request)
    {
        $book = Book::find($request->book_id);
        if ($book->available_quantity > 1) {
            $book->available_quantity--;
            $book->save();
        } else {
            $book->available_quantity = 0;
            $book->status = 'unavailable';
            $book->save();
        }
        $data = [];
        $data['book_id'] = $request->book_id;
        $data['user_id'] = auth()->user()->id;
        $data['borrow_date'] = date('Y-m-d');
        $data['due_date'] = date('Y-m-d', strtotime('+7 days'));


        BookBorrowing::create($data);
        return redirect()->route('site.books.index');
    }

    public function create()
    {
        $categories = Category::get();
        return view("web.site.pages.books.create", compact('categories'));
    }

    public function store(Request $request)
    {
        $data = [];
        $data['title'] = $request->title;
        $data['author'] = $request->author;
        $data['isbn'] = $request->isbn;
        $data['description'] = $request->description;
        $data['quantity'] = $request->quantity;
        $data['available_quantity'] = $request->available_quantity;
        $data['status'] = $request->status;
        $data['category_id'] = $request->category_id;
        if($request->hasFile('cover_image')){
            $file = $request->file('cover_image');
            $filename = $file->store('/books','public');
            $data['cover_image'] = 'storage/' . $filename;
        }

        $book = Book::create($data);
        
        return redirect()->route('site.home')->with('success', 'Book added successfully');
    }

    public function destroy(Request $request)
    {
        $book = Book::find($request->book_id);
        $book->delete();
        return redirect()->back();
    }

    public function edit(Request $request)
    {
        $book = Book::find($request->book_id);
        // dd($book);
        return view('web.site.pages.books.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        $data = [];
        $data['title'] = $request->title;
        $data['author'] = $request->author;
        $data['isbn'] = $request->isbn;
        $data['description'] = $request->description;
        $data['quantity'] = $request->quantity;
        $data['available_quantity'] = $request->available_quantity;
        $data['status'] = $request->status;
        $book->update($data);
        return redirect()->back();
    }
}
