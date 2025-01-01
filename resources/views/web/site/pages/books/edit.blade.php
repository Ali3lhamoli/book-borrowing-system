@extends('web.site.app')

@section('title', 'Edit Book')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">Edit Book</h1>

        <!-- Form for editing the book -->
        <form action="{{ route('site.books.update', [$book->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ $book->title }}" required>
            </div>

            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" id="author" name="author" class="form-control" value="{{ $book->author }}" required>
            </div>

            <div class="mb-3">
                <label for="isbn" class="form-label">ISBN</label>
                <input type="text" id="isbn" name="isbn" class="form-control" value="{{ $book->isbn }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control" rows="4" required>{{ $book->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" id="quantity" name="quantity" class="form-control" value="{{ $book->quantity }}" required>
            </div>

            <div class="mb-3">
                <label for="available_quantity" class="form-label">Available Quantity</label>
                <input type="number" id="available_quantity" name="available_quantity" class="form-control" value="{{ $book->available_quantity }}" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-select" required>
                    <option value="available" {{ $book->status === 'available' ? 'selected' : '' }}>Available</option>
                    <option value="unavailable" {{ $book->status === 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
