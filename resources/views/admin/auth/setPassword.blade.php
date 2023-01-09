@extends('admin.layouts.authTop')

@section('content')
<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-12 d-flex flex-column align-self-center mx-auto">
    <div class="card mt-3 mb-3">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.setPassword.submit') }}">
                @csrf
                
                <div class="row">
                    <div class="col-md-12 mb-3">
                        
                        <h2>Setup Your Password</h2>
                        <p>Enter New Password and password</p>
                        
                    </div>

                    <input type="hidden" name="no" value="{{ $no }}">
                    
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autofocus>
                            
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            
                            @error('no')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="mb-4">
                            <button class="btn btn-secondary w-100" type="submit">{{ __('Reset') }}</button>
                        </div>
                    </div>
                    
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    
                    <div class="col-12">
                        <hr>
                    </div>
                    
                    
                </div>
                
            </form>
        </div>
    </div>
    @endsection