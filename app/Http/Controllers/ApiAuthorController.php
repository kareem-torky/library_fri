<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiAuthorController extends Controller
{
    public function index()
    {
        $authors = Author::with('books')->get();

        return response()->json($authors);
    }

    public function show($id)
    {
        $author = Author::with('books')->find($id);

        return response()->json($author);

    }

    public function store(Request $request)
    {
        // validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'bio' => 'required|string',
            'img' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()		
            ]);
        }
    

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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'bio' => 'required|string',
            'img' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()		
            ]);
        }

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
