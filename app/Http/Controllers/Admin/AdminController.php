<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Borrowing;
use App\Models\Book;

class AdminController extends Controller
{
    public function index (){
        $books = Book::latest()->get();
        $borrowing = Borrowing::latest()->get();


        $totalBook = $books->count();
        $totalLoans = $borrowing->where('status', 'borrowed')->count();
        
        return view('admin.index', compact('books', 'totalBook', 'totalLoans'));
    }

}
