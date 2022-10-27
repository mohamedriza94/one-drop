@extends('hospital.layouts.authTop')

@section('content')
<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-12 d-flex flex-column align-self-center mx-auto">
                    <div class="card mt-3 mb-3">
                        <div class="card-body">
                        <form method="POST" action="{{ route('hospital.login.submit') }}">
                        @csrf

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    
                                    <h2>Hospital Login</h2>
                                    <p>Enter Hospital Number and password</p>
                                    
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Hospital No.</label>
                                        <input id="no" type="text" class="form-control @error('no') is-invalid @enderror" name="no" value="{{ old('no') }}" required autocomplete="no" autofocus>

                                        @error('no')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                </div>
                               
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                </div>
                     
                                <div class="col-12">
                                    <div class="mb-4">
                                        <button class="btn btn-secondary w-100" type="submit">{{ __('Login') }}</button>
                                    </div>
                                </div>

                                
                                <div class="col-12">
                                    <hr>
                                </div>

                                <div class="col-12">
                                    <div class="text-center">
                                    <p class="mb-0">
                                    <a class="" href="{{ Route('hospital.forgotPassword') }}">
                                        Forgot Password
                                    </a>
                                    </p>
                                    </div>
                                </div>


                                
                            </div>
                        
                            </form>
                    </div>
                </div>
                            @endsection