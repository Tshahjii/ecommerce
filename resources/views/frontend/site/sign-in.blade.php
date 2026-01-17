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
                            <h3 class="h4 mb-0">Sign In</h3>
                            <img class="logo-dark" src="{{ asset('frontend/assets/img/logo.png') }}" title=""
                                alt="" width="120" height="40" />
                            <img class="logo-light" src="{{ asset('frontend/assets/img/logo_light.png') }}" title=""
                                alt="" width="120" height="40" />
                        </div>
                        <div class="card-body">
                            <h4 class="fw-bold mb-3">Sign in or create account</h4>
                            <form action="{{ route('sign-in-data') }}" method="POST" autocomplete="off">
                                @csrf
                                <label class="form-label me-5">Enter mobile number<span class="text-danger">*</span></label>
                                <input type="hidden" id="country_code" name="country_code">
                                <input type="tel" id="mobile_no" name="mobile_no"
                                    class="form-control @error('mobile_no') is-invalid @enderror"
                                    placeholder="Enter valid Mobile no."
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                @error('mobile_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <button type="submit" class="btn btn-primary btn w-100 mt-3">
                                    Continue
                                </button>

                                <p class="small mt-2">
                                    By continuing, you agree to our
                                    <a href="#">Conditions of Use</a> and
                                    <a href="#">Privacy Notice</a>.
                                </p>

                                <hr>

                                <p class="text-center">
                                    <strong>Buying for work?</strong><br>
                                    <a href="#">Create a free business account</a>
                                </p>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
