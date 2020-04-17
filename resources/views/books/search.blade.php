@extends('layouts.app')

@section('title')
  search results
@endsection

@section('content')

  <h1>Search Results</h1>

  @foreach($authors as $author)

    <hr>
    <h3> {{ $author->name }} </h3>
    <p> {{ $author->bio }} </p>

  @endforeach

@endsection

