@if (session('message'))
    <div class="alert alert-{{ session('type') }}">
        Session message: {{ session('message') }}
    </div>
@endif
@if(isset($message))
    <div class="alert alert-{{ $type }}">
        Message: {{ $message }}
    </div>
@endif

@include('layouts.errors')