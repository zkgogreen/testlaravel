   @if($message = Session::get('success'))
                  <div class="alert alert-success text-center alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
       {{ $message }}
    </div>
            @elseif($message =  Session::get('error'))
               <div class="alert alert-danger text-center alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
       {{ $message }}
    </div>
    @elseif($message = Session::get('deleted'))
    <div class="alert alert-success text-center alert-dismissible" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
{{ $message }}
</div>
    @endif

    @if (isset($errors) && $errors->any())
<div class="alert alert-danger text-center alert-dismissible" role=" alert">
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
@foreach ($errors->all() as $error)
{{ $error }}
@endforeach
</div>
@endif