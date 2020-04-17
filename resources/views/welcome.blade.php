@extends('layouts.app')

@section('content')

<div id="msgSuccess" class="alert alert-success"></div>
<div id="msgErrors" class="alert alert-danger"></div>

<form id="msgForm">
  @csrf
  <div class="form-group">
  <input type="text" class="form-control" placeholder="name" name="name">
  </div>

  <div class="form-group">
  <textarea class="form-control" rows="5" placeholder="message" name="msg"></textarea>
  </div>

  <button type="submit" class="btn btn-primary">Send</button>
</form>

@endsection

@section('scripts')
<script>
$('#msgSuccess').hide()
$('#msgErrors').hide()

$('#msgForm').submit(function(e){
  e.preventDefault()
  $('#msgSuccess').hide()
  $('#msgErrors').hide()
  $('#msgErrors').empty()

  let msgData = new FormData($('#msgForm')[0])

  $.ajax({
    type: "POST",
    url: "{{ route('message.send') }}",
    data: msgData,
    contentType: false,
    processData: false,
    success: function (data) 
    {
      $('#msgSuccess').show()
      $('#msgSuccess').text(data.success);
    }, 
    error: function (xhr, status, error) 
    {
      $('#msgErrors').show()

      $.each(xhr.responseJSON.errors, function (key, item) 
      {
        $('#msgErrors').append("<p class='mb-0'>" + item + "</p>")
      });    
    }
  });


});

</script>
@endsection