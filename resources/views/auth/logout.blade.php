@extends('auth.layouts')

@section('content')

<script type="text/javascript">
window.history.forward(-1);
</script>

<div class="row justify-content-center mt-5">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">Login</div>
            <div class="card-body">
                   @if ($message = Session::get('success')) 
                    <div class="alert alert-success">
                    {{ $message }}  
                    </div>
                @else
                  
                @endif   
                
                
            </div>
        </div>
    </div>    
</div>
    
@endsection

<!-- resources/views/layouts/app.blade.php -->

<!-- ... your existing HTML ... -->

<!-- JavaScript to disable back button -->
<!-- <script>
    window.onload = function () {
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    };
</script> -->
