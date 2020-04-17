@extends('layouts.app')

@section('title')
  show author - {{ $author->id }}
@endsection

@section('content')

  <h1>Show author - {{ $author->id }}</h1>

  <hr>

  @if($author->img !== null)
    <img src='{{ asset("uploads/$author->img") }}' width="300" height="300">
  @endif

  <h3>{{ $author->name }}</h3>
  <p>{{ $author->bio }}</p>
  <hr>

  <h3>Books</h3>

  @foreach ($author->books as $b)
    <a href="{{ route('books.show', $b->id) }}">
      <p>{{ $b->name }}</p>
    </a>
  @endforeach

  <a href="{{ route('authors.index') }}">Back</a>

@endsection



