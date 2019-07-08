@if (session('flash_message'))
    <span class="alert alert-success">
    {{ session('flash_message') }}
     </span>
@endif
@if (session('error_message'))
    <span class="alert alert-danger">
     {{ session('error_message') }}
     </span>
@endif