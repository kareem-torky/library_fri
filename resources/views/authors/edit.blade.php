@extends('layouts.app')

@section('title')
  Edit Author - {{ $author->name }}
@endsection

@section('content')

@include('inc.errors')

<form method="POST" action="{{ route('authors.update', $author->id) }}" enctype="multipart/form-data">
  @csrf

  <div class="form-group">
    <input type="text" class="form-control" name="name" placeholder="name" value="{{ $author->name }}">
  </div>
  <div class="form-group">
    <textarea class="form-control" rows="8" name="bio" placeholder="biography">{{ $author->bio }}</textarea>
  </div>

  @if($author->img !== null)
    <img src='{{ asset("uploads/$author->img") }}' width="100" height="100">
  @endif


  <div class="form-group">
    <input type="file" class="form-control-file" name="img">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection