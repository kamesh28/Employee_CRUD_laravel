@extends('auth.layouts')

@section('content')

<script type="text/javascript">
window.history.forward(-1);
</script>

<div class="row justify-content-center mt-5">
    <div class="col-md-8">

        <div class="card">
        
                @if ($message = Session::get('success')) 
                    <div class="alert alert-success">
                    {{ $message }}  
                    </div>
                @else
                    <!-- <div class="alert alert-success">
                        You are successfully logged into the Dashboard!!!
                       
                    </div>  -->

                @endif   
         
            <div class="card-header">Login</div>
            <div class="card-body">
                <!--  -->
                
            </div>
                 <!--  -->
                <form action="{{ route('authenticate') }}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email Address</label>
                        <div class="col-md-6">
                          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-md-4 col-form-label text-md-end text-start">Password</label>
                        <div class="col-md-6">
                          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Login">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
</div>
    
@endsection

<!-- resources/views/layouts/app.blade.php -->

<!-- ... your existing HTML ... -->

<!-- JavaScript to disable back button -->
<script>
    window.onload = function () {
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    };
</script>
