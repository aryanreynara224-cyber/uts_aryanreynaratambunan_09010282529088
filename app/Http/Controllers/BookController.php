<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // 1. Tampilkan Daftar Buku (Read) + Fitur Pencarian & Filter (Poin Bonus)
    public function index(Request $request)
    {
        $query = Book::with('category');

        // Bonus: Pencarian Berdasarkan Judul atau Penulis
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

        // Bonus: Filter Berdasarkan Kategori
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $books = $query->latest()->get();
        $categories = Category::all();

        return view('books.index', compact('books', 'categories'));
    }

    // 2. Tampilkan Form Tambah Buku (Create)
    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    // 3. Simpan Buku Baru ke Database
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'publisher'   => 'required|string|max:255',
            'year'        => 'required|numeric',
            'stock'       => 'required|numeric',
        ]);

        Book::create($request->all());

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    // 4. Menampilkan Detail Buku (Detail)
    public function show(Book $book)
    {
        $book->load('category');
        return view('books.show', compact('book'));
    }

    // 5. Tampilkan Form Edit Buku (Update)
    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    // 6. Simpan Perubahan Edit Buku
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'publisher'   => 'required|string|max:255',
            'year'        => 'required|numeric',
            'stock'       => 'required|numeric',
        ]);

        $book->update($request->all());

        return redirect()->route('books.index')->with('success', 'Data buku berhasil diperbarui!');
    }

    // 7. Hapus Buku (Delete)
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus!');
    }
}