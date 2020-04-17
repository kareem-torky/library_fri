<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Author;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('id', 'DESC')->paginate(3);

        return view('books/index', [
            'books' => $books
        ]);
    }
    
    //     public function latest()
    //     {
    //         $books = book::orderBy('id', 'DESC')
    //         ->take(3)
    //         ->get();
    
    //         return view('books.latest', [
    //             'books' => $books
    //         ]);
    //     }
    
    public function show($id)
    {
        $book = Book::find($id);

        return view('books.show', [
            'book' => $book
        ]);
    }
    
    //     public function search($word)
    //     {
    //         $books = book::where('name', 'like', "%$word%")->get();
    
    //         return view('books.search', [
    //             'books' => $books
    //         ]);
    //     }
    
    public function create()
    {
        $authors = Author::select('id', 'name')->get();
        return view('books.create', [
            'authors' => $authors
        ]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'desc' => 'required|string',
            'img' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'price' => 'required|numeric|max:999999.99',
            'author_id' => 'required|exists:authors,id'
        ]);

        // move image to public/uploads
        $img = $request->img;
        $ext = $img->getClientOriginalExtension();
        $name = "book-" . uniqid() . ".$ext";
        $img->move( public_path('uploads') , $name );

        Book::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'img' => $name,
            'price' => $request->price,
            'author_id' => $request->author_id,
        ]);

        return redirect( route('books.index') );
    }
    
    public function edit($id)
    {
        $book = Book::find($id);
        $authors = Author::select('id', 'name')->get();

        return view('books.edit', [
            'book' => $book,
            'authors' => $authors
        ]);
    }
    
    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'desc' => 'required|string',
            'img' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'price' => 'required|numeric|max:999999.99',
            'author_id' => 'required|exists:authors,id'
        ]);

        $book = Book::find($id);
        $name = $book->img;

        // if he uploaded new image
        if($request->hasFile('img'))
        {
            // delete the old 
            if($name !== null)
                unlink( public_path("uploads/$name") );

            // upload the new
            $img = $request->img;
            $ext = $img->getClientOriginalExtension();
            $name = "book-" . uniqid() . ".$ext";
            $img->move( public_path('uploads') , $name );    
        }

        $book->update([
            'name' => $request->name,
            'desc' => $request->desc,
            'img' => $name,
            'price' => $request->price,
            'author_id' => $request->author_id
        ]);

        return back();
    }
    
        public function delete($id)
        {
            $book = Book::find($id);
    
            // delete image from uploads folder 
            $name = $book->img;

            if($name !== null)
                unlink( public_path("uploads/$name") );
    
            $book->delete();
    
            return redirect( route('books.index') );
        }
}