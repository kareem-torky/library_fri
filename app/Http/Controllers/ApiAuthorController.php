<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;

class ApiAuthorController extends Controller
{
    public function index()
    {
        $authors = Author::get();

        return response()->json($authors);
    }

    public function show($id)
    {
        $author = Author::find($id);

        return response()->json($author);

    }

    public function store(Request $request)
    {
        // validation

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

        return response()->json([
            'success' => 'author created successfully'
        ]);
    }

    public function update($id, Request $request)
    {
        //validation

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

        return response()->json([
            'success' => 'author updated successfully'
        ]);
    }

    public function delete($id)
    {
        $author = Author::find($id);

        // delete image from uploads folder 
        $name = $author->img;
        if($name !== null)
            unlink( public_path("uploads/$name") );

        $author->delete();

        return response()->json([
            'success' => 'author deleted successfully'
        ]);
    }
}
