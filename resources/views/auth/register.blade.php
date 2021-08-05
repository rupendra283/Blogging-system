@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <ul id="errors">

                    </ul>

                    <form action="" method="post" id="regForm">
                        <div class="row">

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="image">Upload Image</label>
                                    <input id="image" class="form-control" type="file" name="image">
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="user_name">User Name</label>
                                    <input id="user_name" class="form-control"  placeholder="Enter User Name" type="text" name="user_name">
                                    <span class="text-danger" id="username-err"></span>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="mobile_no">Mobile No</label>
                                    <input id="mobile_no" class="form-control"  placeholder="Enter User Name" type="text" name="mobile_no">
                                    <span class="text-danger" id="mobile_err"></span>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="email">Enter Email</label>
                                    <input id="email" class="form-control" placeholder="Enter Email" type="text" name="email">
                                    <span class="text-danger" id="email-err"></span>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="company_name">Company Name</label>
                                    <input id="company_name" class="form-control" placeholder="Enter Company Name" type="text" name="company_name">
                                    <span class="text-danger" id="company_err"></span>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="password">Enter Password</label>
                                    <input id="password" class="form-control" placeholder="Enter Password" type="password" name="password">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="conpassword">Cofirm Password</label>
                                    <input id="conpassword" class="form-control" placeholder="Enter Password" type="password" name="password_confirmation">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>






                    </form>


                    {{-- <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form> --}}
                </div>
            </div>
        </div>
    </div>
</div>

<script>



$(document).ready(function () {
     $('#regForm').on('submit',function(e){
        e.preventDefault();
     let formData = new FormData(this);
    //  let validated = validatedForm(formData);


    //  if(validated){

        $.ajaxSetup({
            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'accept':'appplication/json'
            }
        });
        $.ajax({
            url: "/register",
            type: "POST",
            dataType: "json",
            processData: false,
            contentType: false,
            data: formData,
            success: function (response) {
                console.log(response);
                // window.location = "/login";
                if (response.success== true){

                    window.location= "/login"
                }

            },


            error: function(err){
                    var errors = err.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        var li = `<li>${value[0]}</li>`
                        $('#errors').append(li);


                    });

            },




        });

    //  }



     });




//      function validatedForm(inputData){

// if (inputData.get('user_name') == '') {
// $('#username-err').text('Please Enter username');
// return false;
// }
// else
// {
// $('#username-err').text('');
// }

// if (inputData.get('email') == '') {
// $('#email-err').text('Please Enter Email');
// return false;
// }
// else
// {
// $('#email-err').text('');
// }
// if (inputData.get('company_name') == '') {
// $('#company_err').text('Please Enter Company Name');
// return false;
// }
// else
// {
// $('#company_err').text('');
// }
// if (inputData.get('mobile_no') == '') {
// $('#mobile_err').text('Please Enter Mobile No');
// return false;
// }

// else
// {
// $('#mobile_err').text('');
// }
// return true;




// }

});









</script>

@endsection
