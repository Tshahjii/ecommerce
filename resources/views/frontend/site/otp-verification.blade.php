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
            <div class="row justify-content-center">
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
                            <h4 class="fw-bold mb-3">Authentication required</h4>
                            <form action="{{ route('user-verify-otp') }}" method="POST" autocomplete="off">
                                @csrf
                                <span class="text-black small">
                                    <strong>{{ $country }} {{ $mobile }}</strong><a
                                        href="{{ route('sign-in') }}"> Change</a><br>
                                    We’ve sent a One Time Password (OTP) to the mobile number above. Please enter it to
                                    complete verification!
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
                            </form>
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
                                        href="{{ route('user-verified-by-otp', ['ctry' => $country, 'mbl' => $mobile, 'token' => $token]) }}">Send
                                        OTP to Whatsapp</a></strong><br>
                                <strong><a
                                        href="{{ route('password', ['ctry' => encrypt($country), 'mbl' => encrypt($mobile), 'token' => $token]) }}">Sign
                                        with your password</a></strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
