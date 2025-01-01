@extends('web.site.app')

@section('title', 'Add Book')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">Add Book</h1>

        <!-- Form for adding a new book -->
        <form action="{{ route('site.books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" id="author" name="author" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="isbn" class="form-label">ISBN</label>
                <input type="text" id="isbn" name="isbn" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" id="quantity" name="quantity" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="available_quantity" class="form-label">Available Quantity</label>
                <input type="number" id="available_quantity" name="available_quantity" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-select" required>
                    <option value="available">Available</option>
                    <option value="unavailable">Unavailable</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select id="category_id" name="category_id" class="form-select" required>
                    <option value="">Select a Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="cover_image" class="form-label">Cover Image</label>
                <input type="file" id="cover_image" name="cover_image" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Add Book</button>
        </form>
    </div>
@endsection
