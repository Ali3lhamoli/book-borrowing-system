<?php

namespace App\Http\Controllers\Site;

// use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('web.site.pages.home');
    }
}
