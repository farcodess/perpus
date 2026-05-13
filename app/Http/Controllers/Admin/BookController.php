<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();

        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        return view('admin.books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'author' => 'required|string|max:20',
            'publisher' => 'required|string|max:15',
            'stock' => 'required|integer|min:0',
            'isbn' => 'required|string|max:15|unique:books,isbn',
            'year_published' => 'required|digits:4',
            'cover_image' => 'nullable|image|mimes:jpg,png,jpeg:max:2048'
        ], [
            'cover_image.image' => 'File harus berupa gambar',
            'cover_image.mimes' => 'Format gambar tidak didukung, gunakan jpg, png, jpeg',
            'cover_image.max' => 'Ukuran gambar terlalu besar'
        ]);
        try {
            $imagePath = null;

            if ($request->hasFile('cover_image')) {
                $imagePath = $request->file('cover_image')->store('covers', 'public');
            }


            Book::create([
                'title' => $request->title,
                'author' => $request->author,
                'publisher' => $request->publisher,
                'stock' => $request->stock,
                'isbn' => $request->isbn,
                'year_published' => $request->year_published,
                'cover_image' => $imagePath,
            ]);
            return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'author' => 'required|string|max:20',
            'publisher' => 'required|string|max:15',
            'stock' => 'required|integer|min:0',
            'isbn' => 'required|string|max:15|unique:books,isbn,' . $book->id,
            'year_published' => 'required|digits:4',
            'cover_image' => 'nullable|image|mimes:jpg,png,jpeg:max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        try {
            $book->update($data);
            return redirect()->route('admin.books.index')->with('success', 'Data buku berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $books = Book::findOrFail($id);
            $books->delete();
            return redirect()->back()->with('success', 'Data buku berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data buku');
        }
    }
}
