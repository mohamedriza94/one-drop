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
                <form method="POST" action="{{ route('donor.setPassword.submit') }}">
                    @csrf

                    <input type="hidden" name="no" value="OD{{ $no }}">
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="default-01">New Password</label>
                        </div>
                        <div class="form-control-wrap">
                            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autofocus>
                            @error('password')
                            <label class="form-label text-danger">{{ $message }}</label>
                            @enderror
                            
                            @error('no')
                            <label class="form-label text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="password">Confirm Password</label>
                        </div>
                        <div class="form-control-wrap">
                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                            </a>
                            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password_confirmation" required>
                        </div>
                    </div>

                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif

                    <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Reset</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- wrap @e -->
@endsection