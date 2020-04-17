@extends('layouts.app')

@section('title')
  latest authors
@endsection

@section('content')
  <h1>Latest authors</h1>

  @foreach ($authors as $author)

    <hr>
    <h3> {{ $author->name }} </h3>
    <p> {{ $author->bio }} </p>
      
  @endforeach
@endsection
