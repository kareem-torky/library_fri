@extends('layouts.app')

@section('title')
    All authors
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
    <h1>All authors</h1>
    <a href="{{ route('authors.create') }}" class="btn btn-success">Add new</a>
  </div>

  @foreach($authors as $author)

    <hr>

    @if($author->img !== null)
      <img src='{{ asset("uploads/$author->img") }}' width="100" height="100">
    @endif

    <a href="{{ route('authors.show', $author->id) }}">
      <h3> {{ $author->name }} </h3>
    </a>
    <p> {{ $author->bio }} </p>
    <a href="{{ route('authors.show', $author->id) }}" class="btn btn-primary">Show</a>
    <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-info">Edit</a>
    <a href="{{ route('authors.delete', $author->id) }}" class="btn btn-danger">Delete</a>

  @endforeach

  {!! $authors->render() !!}

@endsection