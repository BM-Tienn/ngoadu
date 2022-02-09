@extends("layouts.master")
@section("do-du-lieu")

<div class="page-breadcrumb" style="margin-top: -20px; margin-left:-20px">
    <div class="row" >
        <div class="col-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb"  style="background: #EEF5F9">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" title="Dashboard">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Change password</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 mt-5">  
    <div class="panel panel-primary">
        <div class="panel-body">

            <form id="myForm" onsubmit="return checkForm(this);" method="POST" action="{{ route('user.change', ['id' => Auth::user()->id]) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @csrf 
                @method('GET')
            <!-- rows -->
            <div class="row w-50 mt-4" >
                <div class="col-md-4 font-weight-normal" style="color: black">Old Password</div>
                <div class="col-md-8">
                    <input id="password" type="password" value="" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" required style="color:black;background:white">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
            </div>
            <!-- end rows -->
            <div class="row w-50 mt-4" >
                <div class="col-md-4 font-weight-normal" style="color: black">New password</div>
                <div class="col-md-8">
                    <input id="new_password" type="password" value="" name="new_password" class="form-control form-control-lg @error('new_password') is-invalid @enderror" required style="color:black;background:white">
                        @error('new_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
            </div>
            <!-- end rows -->
             <!-- end rows -->
             <div class="row w-50 mt-4" >
                <div class="col-md-4 font-weight-normal" style="color: black">Confirm password</div>
                <div class="col-md-8">
                    <input id="confirm_password" type="password" value="" name="confirm_password" class="form-control form-control-lg @error('confirm_password') is-invalid @enderror" required style="color:black;background:white">
                        @error('confirm_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                
            </div>

            <!-- end rows -->
            <!-- rows -->
            <div class="row w-50 mt-1 mb-2">
                <div class="col-md-4"></div>
                <div class="col-md-8" style="color: black">
                    <input type="checkbox" class="mr-2 mt-2" onclick="myFunction()">Show Password
                </div>
            </div>
            <!-- end rows -->
            <!-- rows -->
            <div class="row w-50 mt-4">
                <div class="col-md-4"></div>
                <div class="col-md-8">
                    <input type="submit" value="Change" class="btn btn-primary px-5">
                </div>
            </div>
            <!-- end rows -->
        </form>
        </div>
    </div>
</div>
<script>

    function checkForm(form)
    {
    form.myButton.disabled = true;
    form.myButton.value = "Please wait...";
    return true;
    }

    function resetForm(form)
    {
    form.myButton.disabled = false;
    form.myButton.value = "Submit";
    }

    function myFunction() {
    var x = document.getElementById("password");
    var y = document.getElementById("new_password");
    var z = document.getElementById("confirm_password");
    if (x.type === "password") {
        x.type = "text";
        y.type = "text";
        z.type = 'text';
    } else {
        x.type = "password";
        y.type = "password";
        z.type = "password";
        
      
    }
    }
  </script>
@endsection