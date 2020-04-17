@extends('layouts.app')

@section('title')
    All books
@endsection

@section('styles')
  <style>
    h1 {
      color: red;
    }
  </style>
@endsection

@section('content')

  <div class="d-flex justify-content-between align-items-start">
    <h1>All books</h1>

    @auth
    <a href="{{ route('books.create') }}" class="btn btn-success">Add new</a>
    @endauth 
    
  </div>

  @foreach($books as $book)

    <hr>

    @if($book->img !== null)
      <img src='{{ asset("uploads/$book->img") }}' width="100" height="100">
    @endif

    <a href="{{ route('books.show', $book->id) }}">
      <h3> {{ $book->name }} </h3>
    </a>
    <p> {{ $book->desc }} </p>
    <p> {{ $book->price }} </p>
    
    <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">Show</a>

    @auth
    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-info">Edit</a>
    <a href="{{ route('books.delete', $book->id) }}" class="btn btn-danger">Delete</a>
    @endauth 

  @endforeach

  {!! $books->render() !!}

@endsection