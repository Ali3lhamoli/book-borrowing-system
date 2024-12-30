<?php


function get_file_url(?string $path = null) {
    return ($path) ? asset($path) : asset('storage/books/default_book.png');
}