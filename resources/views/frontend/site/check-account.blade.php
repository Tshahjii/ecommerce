@extends('frontend.layout.main')
@section('title', 'Authentication Required')
@section('content')
    <div class="py-3 bg-gray-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 my-2">
                    <h1 class="m-0 h4 text-center text-lg-start">New User</h1>
                </div>
                <div class="col-lg-6 my-2">
                    <ol class="breadcrumb dark-link m-0 small justify-content-center justify-content-lg-end">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home-page') }}" class="text-nowrap">
                                <i class="fa-sharp fa-regular fa-house"></i>&nbsp;Home /
                            </a>
                        </li>
                        <li class="active text-nowrap" aria-current="page">&nbsp;New User</li>
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
                            <h3 class="h4 mb-0">New User</h3>
                            <img class="logo-dark" src="{{ asset('frontend/assets/img/logo.png') }}" title=""
                                alt="" width="120" height="40" />
                            <img class="logo-light" src="{{ asset('frontend/assets/img/logo_light.png') }}" title=""
                                alt="" width="120" height="40" />
                        </div>
                        <div class="card-body">
                            <h4 class="fw-bold mb-3">Looks like you are new here</h4>
                            <form>
                                <p class="form-label mb-3">Create an account using your mobile number<br>
                                    <strong>{{ $country }} {{ $mobile }}</strong><a
                                        href="{{ route('sign-in') }}"> Change</a>
                                </p>
                                <a
                                    href="{{ route('sign-up', ['ctry' => urlencode(encrypt($country)), 'mbl' => urlencode(encrypt($mobile))]) }}"class="btn btn-primary w-100 mb-3">Proceed
                                    to Create Account</a>
                                <p class="small mb-3 text-center">
                                    Already a customer? <a href="#">Sign in with another email or mobile</a>.
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
