
@if($errors->any())
<div class="alert alert-danger">
  @foreach ($errors->all() as $err)
    <p class="mb-0">{{ $err }}</p>      
  @endforeach
</div>
@endif
