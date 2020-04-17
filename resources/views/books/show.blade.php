@extends('layouts.app')

@section('title')
  show book - {{ $book->id }}
@endsection

@section('content')

  <h1>Show book - {{ $book->id }}</h1>

  <hr>

  @if($book->img !== null)
    <img src='{{ asset("uploads/$book->img") }}' width="300" height="300">
  @endif

  <h3>{{ $book->name }}</h3>
  <p>{{ $book->desc }}</p>
  <p>${{ $book->price }}</p>

  <p>By: 
    <a href="{{ route('authors.show', $book->author->id) }}">
    {{ $book->author->name }}
    </a>
  </p>
  <p>brief description about author: {{ $book->author->bio }}</p>

  <hr>

  <a href="{{ route('books.index') }}">Back</a>

@endsection



