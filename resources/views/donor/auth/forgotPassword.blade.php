@extends('donor.layouts.authTop')

@section('content')
<div class="nk-content ">
    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
        <div class="card card-bordered">
                
            <div class="card-inner card-inner-sm" >
                <div class="alert alert-success alert-dismissible fade show mb-4 d-none" role="alert" id="successAlert">
                    <strong></strong>
                </div>
            </div>

            {{-- forgot password --}}
            <div class="card-inner card-inner-lg" id="sendCodeContent"> 
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">Forgot Password</h4>
                        <div class="nk-block-des">
                            <p>Enter your registered Email</p>
                        </div>
                    </div>
                </div>

                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="default-01">Email</label>
                        </div>
                        <div class="form-control-wrap">
                            <input id="email" type="email" class="form-control form-control-lg" name="email">
                            <label class="form-label text-danger" id="emailError"></label>
                        </div>
                        
                        <button class="btn btn-lg btn-primary btn-block" id="btnSendVerificationCode">Send Verification Code</button>
                    </div>
                <div class="form-note-s2 text-center pt-4"><a href="{{ Route('donor.login') }}">Back to Login</a>
                </div>
            </div>
            {{-- end --}}

            {{-- verification --}}
            <div class="card-inner card-inner-lg d-none" id="verifyCodeContent">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">Verification</h4>
                        <div class="nk-block-des">
                            <p>We've sent a verification code to your Email. Please enter it here</p>
                        </div>
                    </div>
                </div>

                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="default-01">Enter the code</label>
                        </div>
                        <div class="form-control-wrap">
                            <input id="code" type="text" class="form-control form-control-lg" name="code">
                            <label class="form-label text-danger" id="codeError"></label>
                        </div>

                        <button class="btn btn-lg btn-primary btn-block" id="btnVerify">Verify</button>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-lg btn-light btn-block" id="btnNewCode">Send New Code</button>
                    </div>

                <div class="form-note-s2 text-center pt-4"><a href="{{ Route('donor.login') }}">Back to Login</a>
                </div>
            </div>
            {{-- end --}}

            {{-- Reset Password --}}
            <div class="card-inner card-inner-lg d-none" id="resetPasswordContent">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">Reset Password</h4>
                        <div class="nk-block-des">
                            <p>Enter your new password here</p>
                        </div>
                    </div>
                </div>

                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="default-01">New Password</label>
                        </div>
                        <div class="form-control-wrap">
                            <input id="password" type="password" class="form-control form-control-lg" name="password">
                            <label class="form-label text-danger" id="passwordError"></label>
                        </div>
                        
                        <div class="form-label-group">
                            <label class="form-label" for="default-01">Confirm New Password</label>
                        </div>
                        <div class="form-control-wrap">
                            <input id="confirmPassword" type="password" class="form-control form-control-lg" name="confirmPassword">
                        </div>
                    </div>


                    <div class="form-group">
                        <button class="btn btn-lg btn-secondary btn-block" id="btnReset">Verify</button>
                    </div>

                <div class="form-note-s2 text-center pt-4"><a href="{{ Route('donor.login') }}">Back to Login</a>
                </div>
            </div>
            {{-- end --}}

        </div>
    </div>
</div>
<!-- wrap @e -->
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

        var url = '{{ url("donor/sendVerificationCode/:email") }}';
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
                    $('#successAlert').text('Code has been sent to your email');

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

        var url = '{{ url("donor/verify/:typedCode/:email") }}';
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

            var url = '{{ url("donor/resetPassword/:typedCode/:email/:password") }}';
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
                    
                    window.location.href = "{{ route('donor.login') }}";

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