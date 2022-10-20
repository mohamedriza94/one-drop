@extends('donor.layouts.authTop')

@section('content')
<div class="nk-content ">
    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
        <div class="card card-bordered">
            <div class="card-inner card-inner-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">Login as a Donor</h4>
                        <div class="nk-block-des">
                            <p>Enter your registered Email and Password</p>
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('donor.login.submit') }}">
                @csrf
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="default-01">Email</label>
                        </div>
                        <div class="form-control-wrap">
                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <label class="form-label text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="password">Password</label>
                            <a class="link link-primary link-sm" href="{{ Route('donor.forgotPassword') }}">Forgot Password?</a>
                        </div>
                        <div class="form-control-wrap">
                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                            </a>
                            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                            <label class="form-label text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block">Login</button>
                    </div>
                </form>
                <div class="form-note-s2 text-center pt-4"><a href="{{ Route('visitor.home') }}">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- wrap @e -->
@endsection