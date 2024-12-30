@extends('web.site.app')

@section('title', 'My Borrowing Books')

@push('style')
<link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush


@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">Books List</h1>
        <table id="books-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Image</th>
                    <th>Borrow_date</th>
                    <th>Due_date</th>
                    {{-- <th>Borrowing</th> --}}
                </tr>
            </thead>
        </table>
    </div>
@endsection

@push('scripts')
    <!-- استدعاء JavaScript الخاص بـ DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#books-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('site.books.borrowed') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'title', name: 'title' },
                    { data: 'author', name: 'author' },
                    { data: 'image', name: 'image' },
                    { data: 'borrow_date', name: 'borrow_date' },
                    { data: 'due_date', name: 'due_date' },
                    // { data: 'borrowing', name: 'borrowing' },
                ]
            });
        });
    </script>
@endpush