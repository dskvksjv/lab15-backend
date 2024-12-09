<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function getCsrfToken()
    {
        return response()->json(['csrf_token' => csrf_token()]);
    }

    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'author' => 'required|string',
            'title' => 'required|string',
            'address' => 'required|string',
            'desriptions' => 'required|string',
        ]);
        $book = Book::create($validated);
        return response()->json($book, 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'author' => 'required|string',
            'title' => 'required|string',
            'address' => 'required|string',
            'desriptions' => 'required|string',
        ]);
        $book = Book::findOrFail($id);
        $book->update($validated);
        return response()->json($book);
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return response()->json(null, 204);
    }

    public function show($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        return response()->json($book);
    }
}
