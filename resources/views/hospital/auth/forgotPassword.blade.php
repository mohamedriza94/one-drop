@extends('hospital.layouts.authTop')

@section('content')
<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-12 d-flex flex-column align-self-center mx-auto">
    <div class="card mt-3 mb-3">
        <div class="card-body">
            <div class="alert alert-success alert-dismissible fade show mb-4 d-none" role="alert" id="successAlert">
                <strong></strong>
            </div>
            
            <div class="row" id="sendCodeContent">
                
                <div class="col-md-12 mb-3">
                    
                    <h2>Forgot Password</h2>
                    
                </div>
                
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Enter your Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                        <label class="form-label" style="color:red" id="emailError"></label>
                    </div>
                </div>
                
                <div class="col-12">
                    <div class="mb-4">
                        <button id="btnSendVerificationCode" class="btn btn-secondary w-100" type="button">Send Verification Code</button>
                    </div>
                </div>
                
            </div>

            <div class="row d-none" id="verifyCodeContent">
                
                <div class="col-md-12 mb-3">
                    
                    <h2>Verification</h2>
                    <p>We've sent a verification code to your email. Please enter it here</p>
                    
                </div>
                
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Enter the code</label>
                        <input type="text" class="form-control" id="code" name="code">
                        <label class="form-label" style="color:red" id="codeError"></label>
                    </div>
                </div>
                
                <div class="col-12">
                    <div class="mb-4">
                        <button id="btnVerify" class="btn btn-secondary w-100" type="button">Verify</button>
                    </div>
                </div>

                <div class="col-12">
                    <div class="mb-4">
                        <button id="btnNewCode" class="btn btn-light w-100" type="button">Send New Code</button>
                    </div>
                </div>
            </div>

            <div class="row d-none" id="resetPasswordContent">
                
                <div class="col-md-12 mb-3">
                    
                    <h2>Reset Password</h2>
                    <p>Enter your new password here</p>
                    
                </div>
                
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" class="form-control" id="password">
                        <label class="form-label" style="color:red" id="passwordError"></label>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirmPassword">
                    </div>
                </div>
                
                <div class="col-12">
                    <div class="mb-4">
                        <button id="btnReset" class="btn btn-secondary w-100" type="button">Reset</button>
                    </div>
                </div>
            </div>
            
            <div class="col-12">
                <div class="text-center">
                    <p class="mb-0"><a href="{{ route('hospital.login') }}">Back to Login</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>

$(document).ready(function(){

//csrf token
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//send verification code
$(document).on('click', '#btnSendVerificationCode',function(e){
    e.preventDefault();
    
    var email = $('#email').val();

    if(email!="")
    {
        $('#btnSendVerificationCode').text('Sending...');

        var url = '{{ url("hospital/sendVerificationCode/:email") }}';
            url = url.replace(':email', email);

        $.ajax({
            type:"POST",
            url: url,
            success:function(response){
                if(response.status==400)
                {
                    $('#emailError').text('Please enter a valid email');

                    $('#btnSendVerificationCode').text('Send Verification Code');
                }
                else if(response.status==200)
                {
                    $('#successAlert').removeClass('d-none');
                    $('#successAlert').text("Code has been sent to the hospital's registered email");

                    $('#emailError').text('');

                    $('#sendCodeContent').addClass('d-none');
                    $('#resetPasswordContent').addClass('d-none');
                    $('#verifyCodeContent').removeClass('d-none');

            }
            }
        });
    }
    else
    {
        $('#btnSendVerificationCode').text('Send Verification Code');
        $('#emailError').text('Email is required');
    }

    
});

//send new code
$(document).on('click', '#btnNewCode',function(e){
    
    $('#sendCodeContent').removeClass('d-none');
    $('#verifyCodeContent').addClass('d-none');

    
    $('#btnSendVerificationCode').text('Send Verification Code');
    $('#successAlert').addClass('d-none')
    $('#successAlert').text('')
});

//Verify code
$(document).on('click', '#btnVerify',function(e){
    e.preventDefault();
    
    $('#successAlert').addClass('d-none');
    $('#successAlert').text('');

    var email = $('#email').val();
    var typedCode = $('#code').val();

    if(email!="" && typedCode!="")
    {
        $('#btnVerify').text('Verifying...');

        var url = '{{ url("hospital/verify/:typedCode/:email") }}';
            url = url.replace(':typedCode', typedCode);
            url = url.replace(':email', email);

        $.ajax({
            type:"get",
            url: url,
            success:function(response){
                if(response.status==400)
                {
                    $('#codeError').text('Code does not match. Please retry');

                    $('#btnVerify').text('Verify');
                }
                else if(response.status==200)
                {
                    $('#successAlert').removeClass('d-none');
                    $('#successAlert').text('Code matched successfully');
                    
                    $('#codeError').text('');
                    $('#btnVerify').text('Verify');

                    $('#sendCodeContent').addClass('d-none');
                    $('#verifyCodeContent').addClass('d-none');
                    $('#resetPasswordContent').removeClass('d-none');

                }
            }
        });
    }
    else
    {
        $('#codeError').text('Verification code is required');
        $('#btnVerify').text('Verify');
    }

        
});

//update password
$(document).on('click', '#btnReset',function(e){
    e.preventDefault();
    
    $('#successAlert').addClass('d-none');
    $('#successAlert').text('');

    var password = $('#password').val();
    var confirmPassword = $('#confirmPassword').val();
    var typedCode = $('#code').val();
    var email = $('#email').val();

    if(password!="" && confirmPassword!="" && typedCode!="" && email!="")
    {
        if(password==confirmPassword)
        {
            $('#btnReset').text('Updating...');

            var url = '{{ url("hospital/resetPassword/:typedCode/:email/:password") }}';
            url = url.replace(':typedCode', typedCode);
            url = url.replace(':email', email);
            url = url.replace(':password', password);

            $.ajax({
            type:"GET",
            url: url,
            success:function(response){
                if(response.status==400)
                {
                    $('#passwordError').text('Token is invalid. Get a new code');
                    $('#btnReset').text('Reset');
                }
                else if(response.status==200)
                {
                    $('#successAlert').removeClass('d-none');
                    $('#successAlert').removeClass('alert-danger');
                    $('#successAlert').addClass('alert-success');
                    $('#successAlert').text('Password reset successfully');

                    $('#btnReset').text('Reset');
                    $('#passwordError').text('');
                    
                    window.location.href = "{{ route('hospital.login') }}";

                }
                else if(response.status==404)
                {
                    $('#passwordError').text('Password should have atleast 6 characters');
                    $('#btnReset').text('Reset');
                }
            }
            });
        }
        else
        {
            $('#passwordError').text('Passwords do not match');
            $('#btnReset').text('Reset');
        }
    }
    else
    {
        
        $('#successAlert').removeClass('d-none');
        $('#successAlert').removeClass('alert-success');
        $('#successAlert').addClass('alert-danger');
        $('#successAlert').text('Data is missing! Enter all data and try again');
        $('#btnReset').text('Reset');
    }
        
    
});
});
</script>
@endsection