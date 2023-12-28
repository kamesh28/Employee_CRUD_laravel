@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
                @if ($message = Session::get('success')) 
                    <div class="alert alert-success">
                    {{ $message }}  
                    </div>
                @else
                    <!-- <div class="alert alert-success">
                        You are successfully logged into the Dashboard!!!
                       
                    </div>  -->

                @endif   
                <div>
                <!-- <button class="btn btn-><a class="nav-link" href="{{ route('employees.index') }}">Employee Details</a></button>-->
                <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"type="button" onclick="window.location.href = 'http://127.0.0.1:8000/employees';">View Employee Details</button>
                <!-- <button class="GFG" onclick="window.location.href = 'http://127.0.0.1:8000/employees';"> Employee Details    </button>  -->
                </div>             
            </div>
        </div>
    </div>    
</div>
    
@endsection
<script>
    window.onload = function () {
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    };
</script>
<!-- <script>
    window.onload = function () {
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
            window.onpopstate = function () {
                window.history.pushState(null, null, window.location.href);
            };
        }
    };
</script> -->