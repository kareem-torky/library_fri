@extends('layouts.app')

@section('title')
    Create Author
@endsection

@section('content')

@include('inc.errors')

<form method="POST" action="{{ route('authors.store') }}" enctype="multipart/form-data">
  @csrf

  <div class="form-group">
    <input type="text" class="form-control" name="name" placeholder="name">
  </div>
  <div class="form-group">
    <textarea class="form-control" rows="8" name="bio" placeholder="biography"></textarea>
  </div>

  <div class="form-group">
    <input type="file" class="form-control-file" name="img">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection