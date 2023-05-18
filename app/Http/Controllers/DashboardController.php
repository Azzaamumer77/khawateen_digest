<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Publication;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $breadcrumbs = [
            ['link'=>"/",'name'=>"Dashboard"], ['name'=>"Dashboard"]
        ];
        $books = Book::count();
        $publications = Publication::count();
        $authors = Author::count();
        return view('dashboard', ['breadcrumbs' => $breadcrumbs,'books' => $books,'publications' => $publications,'authors'=>$authors]);
    }
}
