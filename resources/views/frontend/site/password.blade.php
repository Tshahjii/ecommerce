@extends('frontend.layout.main')
@section('title', 'Authentication Required')
@section('content')
    <div class="py-3 bg-gray-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 my-2">
                    <h1 class="m-0 h4 text-center text-lg-start">Sign In</h1>
                </div>
                <div class="col-lg-6 my-2">
                    <ol class="breadcrumb dark-link m-0 small justify-content-center justify-content-lg-end">
                        <li class="breadcrumb-item"><a class="text-nowrap" href="{{ route('home-page') }}"><i
                                    class="fa-sharp fa-regular fa-house"></i>&nbsp;Home /</a>
                        </li>
                        <li class="text-nowrap active" aria-current="page">&nbsp;Sign In</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="justify-content-center row">
                <div class="col-lg-10 col-xxl-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center bg-transparent py-3">
                            <h3 class="h4 mb-0">Sign In Your Account</h3>
                            <img class="logo-dark" src="{{ asset('frontend/assets/img/logo.png') }}" title=""
                                alt="" width="120" height="40" />
                            <img class="logo-light" src="{{ asset('frontend/assets/img/logo_light.png') }}" title=""
                                alt="" width="120" height="40" />
                        </div>
                        <div class="card-body">
                            <strong>{{ $country }} {{ $mobile }}</strong><a href="{{ route('sign-in') }}">
                                Change</a>
                            <form action="{{ route('user-verify-password') }}" method="POST" autocomplete="off">
                                @csrf
                                <div class="row align-items-center"><label class="form-label col"
                                        for="exampleInputPassword01">Password<span class="text-danger">*</span></label>
                                    <span class="col ms-auto small text-end"><a href="#!">Forgot password?</a></span>
                                </div>
                                <input type="hidden" name="token" value="{{ $token }}">
                                <input type="hidden" name="country" value="{{ $country }}">
                                <input type="hidden" name="mobile" value="{{ $mobile }}">
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Enter password" minlength="6">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <span class="text-black small">
                                    <i class="fa-sharp fa-regular fa-triangle-exclamation"></i> Passwords must be at
                                    least 6 characters.
                                </span>
                                <button type="submit" class="btn btn-primary btn w-100 mt-3">
                                    Sign In
                                </button>

                                <p class="small mt-2">
                                    By continuing, you agree to our
                                    <a href="#">Conditions of Use</a> and
                                    <a href="#">Privacy Notice</a>.
                                </p>

                                <div class="d-flex align-items-center my-3">
                                    <hr class="flex-grow-1">
                                    <span class="mx-2 text-muted">or</span>
                                    <hr class="flex-grow-1">
                                </div>
                                <p class="text-center">
                                    <strong><a
                                            href="{{ route('user-verified-by-otp', ['ctry' => encrypt($country), 'mbl' => encrypt($mobile), 'token' => $token]) }}">Get
                                            an OTP on your phone</a></strong>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
