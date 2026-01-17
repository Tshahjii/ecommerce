@extends('frontend.layout.main')
@section('title', 'Authentication Required')
@section('content')
    <div class="py-3 bg-gray-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 my-2">
                    <h1 class="m-0 h4 text-center text-lg-start">Verify Number</h1>
                </div>
                <div class="col-lg-6 my-2">
                    <ol class="breadcrumb dark-link m-0 small justify-content-center justify-content-lg-end">
                        <li class="breadcrumb-item">
                            <a class="text-nowrap" href="{{ route('home-page') }}">
                                <i class="fa-sharp fa-regular fa-house"></i>&nbsp;Home
                            </a>
                        </li>
                        <li class="text-nowrap active" aria-current="page">Verify Number</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xxl-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center bg-transparent py-3">
                            <h3 class="h4 mb-0">Verify Yourself</h3>
                            <img class="logo-dark" src="{{ asset('frontend/assets/img/logo.png') }}" title=""
                                alt="" width="120" height="40" />
                            <img class="logo-light" src="{{ asset('frontend/assets/img/logo_light.png') }}" title=""
                                alt="" width="120" height="40" />
                        </div>
                        <div class="card-body">
                            <h4 class="fw-bold mb-3">Verify Mobile Number</h4>
                            <form action="{{ route('verify-otp') }}" method="POST" autocomplete="off">
                                @csrf
                                <span class="text-black small">
                                    Enter the OTP (one time password) we sent you.<br>
                                    <strong>{{ $country }} {{ $mobile }}</strong><a
                                        href="{{ route('sign-in') }}"> Change</a>
                                </span>
                                <div class="mb-3 mt-2">
                                    <label for="otp" class="form-label">Enter OTP<span
                                            class="text-danger">*</span></label>
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <input type="hidden" name="country" value="{{ $country }}">
                                    <input type="hidden" name="mobile" value="{{ $mobile }}">
                                    <input type="text" name="otp" id="otp"
                                        class="form-control @error('otp') is-invalid @enderror" maxlength="6"
                                        placeholder="Enter OTP" oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                                    @error('otp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary w-100 mt-3">
                                    Create Your Shahshop Account
                                </button>

                                <p class="small mt-2">
                                    By creating an account or logging in, you agree to
                                    <a href="#">Conditions of Use</a> and
                                    <a href="#">Privacy Notice</a>.
                                </p>

                                <div class="d-flex justify-content-between mt-2">
                                    <strong><a
                                            href="{{ route('resend-otp', ['ctry' => $country, 'mbl' => $mobile, 'token' => $token]) }}">Resend
                                            OTP</a></strong>
                                </div>

                                <div class="d-flex align-items-center my-3">
                                    <hr class="flex-grow-1">
                                    <span class="mx-2 text-muted">or</span>
                                    <hr class="flex-grow-1">
                                </div>
                                <p class="text-center">
                                    <strong><a
                                            href="{{ route('send-otp-in-whatsapp', ['ctry' => $country, 'mbl' => $mobile, 'token' => $token]) }}">Send
                                            OTP to Whatsapp</a></strong>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
