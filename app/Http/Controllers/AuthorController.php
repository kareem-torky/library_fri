<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::orderBy('id', 'DESC')->paginate(3);

        return view('authors/index', [
            'authors' => $authors
        ]);
    }

    public function latest()
    {
        $authors = Author::orderBy('id', 'DESC')
        ->take(3)
        ->get();

        return view('authors.latest', [
            'authors' => $authors
        ]);
    }

    public function show($id)
    {
        $author = Author::find($id);

        return view('authors.show', [
            'author' => $author
        ]);
    }

    public function search($word)
    {
        $authors = Author::where('name', 'like', "%$word%")->get();

        return view('authors.search', [
            'authors' => $authors
        ]);
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'bio' => 'required|string',
            'img' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        // move image to public/uploads
        $img = $request->img;
        $ext = $img->getClientOriginalExtension();
        $name = "author-" . uniqid() . ".$ext";
        $img->move( public_path('uploads') , $name );

        Author::create([
            'name' => $request->name,
            'bio' => $request->bio,
            'img' => $name
        ]);

        return redirect( route('authors.index') );
    }

    public function edit($id)
    {
        $author = Author::find($id);

        return view('authors.edit', [
            'author' => $author
        ]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'bio' => 'required|string',
            'img' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $author = Author::find($id);
        $name = $author->img;

        // if he uploaded new image
        if($request->hasFile('img'))
        {
            // delete the old 
            if($name !== null)
                unlink( public_path("uploads/$name") );

            // upload the new
            $img = $request->img;
            $ext = $img->getClientOriginalExtension();
            $name = "author-" . uniqid() . ".$ext";
            $img->move( public_path('uploads') , $name );    
        }

        $author->update([
            'name' => $request->name,
            'bio' => $request->bio,
            'img' => $name
        ]);

        return back();
    }

    public function delete($id)
    {
        $author = Author::find($id);

        // delete image from uploads folder 
        $name = $author->img;
        if($name !== null)
            unlink( public_path("uploads/$name") );

        $author->delete();

        return redirect( route('authors.index') );
    }
}
