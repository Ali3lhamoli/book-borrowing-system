@extends('web.site.app')

@section('title', 'Home')

@push('style')
<link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush


@section('content')
    <div class="container my-5">
        @include('web.inc.success')
        <h1 class="text-center mb-4">Books List</h1>
        <table id="books-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Availability</th>
                    <th>Borrowing</th>
                    <th>Admin</th>
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
                ajax: '{{ route('site.books.data') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'title', name: 'title' },
                    { data: 'author', name: 'author' },
                    { data: 'image', name: 'image' },
                    { data: 'description', name: 'description' },
                    { data: 'category', name: 'category' },
                    { data: 'availability', name: 'availability' },
                    { data: 'borrowing', name: 'borrowing' },
                    { data: 'admin', name: 'admin'  } // العمود الجديد
                ]
            });
        });
    </script>
@endpush