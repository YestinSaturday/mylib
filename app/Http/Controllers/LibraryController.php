<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    // Show all books
    public function index()
    {
        $books = Library::all();
        return view('library.index', compact('books'));
    }

    // Show form to add a book
    public function create()
    {
        return view('library.create');
    }

    // Save new book
    public function store(Request $request)
    {
        $request->validate([
            'isbn' => 'required|string|max:20|unique:library,isbn',
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'publicationYear' => 'nullable|integer|min:1000|max:2025',
            'category' => 'nullable|string|max:100',
        ]);

        $data = $request->all();
        $data['availability'] = $request->has('availability') ? true : false;
        
        Library::create($data);
        return redirect()->route('library.index')->with('success', 'Book added successfully!');
    }

    // Show specific book details
    public function show(Library $book)
    {
        return view('library.show', compact('book'));
    }

    // Show form to edit a book
    public function edit(Library $book)
    {
        return view('library.edit', compact('book'));
    }

    // Update a book
    public function update(Request $request, Library $book)
    {
        $request->validate([
            'isbn' => 'required|string|max:20|unique:library,isbn,' . $book->id,
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'publicationYear' => 'nullable|integer|min:1000|max:2025',
            'category' => 'nullable|string|max:100',
        ]);

        $data = $request->all();
        $data['availability'] = $request->has('availability') ? true : false;
        
        $book->update($data);
        return redirect()->route('library.index')->with('success', 'Book updated successfully!');
    }

    // Delete a book
    public function destroy(Library $book)
    {
        $book->delete();
        return redirect()->route('library.index')->with('success', 'Book deleted successfully!');
    }
}