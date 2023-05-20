<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Publication;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function data()
    {
        $publications = Publication::get();
        $authors = Author::where('is_popular',1)->get();
        $books = Book::where('is_popular',1)->get();
        return view('home',compact('publications','authors','books'));
    }
}
