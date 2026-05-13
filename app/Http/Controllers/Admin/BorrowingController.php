<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use App\Models\Book;


class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['user', 'book'])->latest()->paginate(10);

        return view('admin.borrowings.index', compact('borrowings'));
    }
    public function returnBook($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $fine = $borrowing->current_fine;

        $borrowing->update([
            'status' => 'returned',
            'return_date' => now(),
            'fine_amount' => $fine,
        ]);

        $borrowing->book->increment('stock');

        if ($fine > 0) {
            return back()->with('success', 'Buku balik. Ada denda: Rp ' . number_format($fine));
        }
        return back()->with('success', 'Buku balik tepat waktu!');
    }

    public function store(Request $request)
    {
        $books = Book::findOrFail($request->book_id);

        if ($books->stock <= 0) {
            return back()->with('error', 'Maaf, stock buku sedang habis');
        }
        
        $currentBorrowingCount = Borrowing::where('user_id', auth()->id())
            ->where('status', 'borrowed') 
            ->count();

        if ($currentBorrowingCount >= 2) {
            return back()->with('error', 'Gagal! Kamu sudah meminjam 2 buku. Kembalikan dulu buku sebelumnya.');
        }

        Borrowing::create([
            'user_id' => auth()->id(),
            'book_id' => $books->id,
            'borrow_date' => now(),
            'due_date' => now()->addDays(7),
            'status' => 'borrowed',
        ]);


        $books->decrement('stock');

        return back()->with('success', 'Buku berhasil dipinjam.');
    }
}
