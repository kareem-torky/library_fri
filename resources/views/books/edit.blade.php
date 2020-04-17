@extends('layouts.app')

@section('title')
  Edit book - {{ $book->name }}
@endsection

@section('content')

@include('inc.errors')

<form method="POST" action="{{ route('books.update', $book->id) }}" enctype="multipart/form-data">
  @csrf

  <div class="form-group">
    <input type="text" class="form-control" name="name" placeholder="name" value="{{ $book->name }}">
  </div>
  <div class="form-group">
    <textarea class="form-control" rows="8" name="desc" placeholder="description">{{ $book->desc }}</textarea>
  </div>
  <div class="form-group">
    <input type="number" class="form-control" name="price" placeholder="price" value="{{ $book->price }}">
  </div>

  <select class="form-control" name="author_id">
    @foreach ($authors as $author)
      <option value="{{ $author->id }}" @if($author->id == $book->author_id ) selected @endif >{{ $author->name }}</option>
    @endforeach
  </select>

  @if($book->img !== null)
    <img src='{{ asset("uploads/$book->img") }}' width="100" height="100">
  @endif


  <div class="form-group">
    <input type="file" class="form-control-file" name="img">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection