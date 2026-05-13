<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class UserController extends Controller
{
    public function index (){
        $books = Book::latest()->get();
        return view('user.index', compact('books'));
    }


}
