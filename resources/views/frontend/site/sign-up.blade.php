@extends('frontend.layout.main')
@section('title', 'Authentication Required')
@section('content')
    <div class="py-3 bg-gray-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-6 my-2">
                    <h1 class="m-0 h4 text-center text-md-start">Sign Up</h1>
                </div>
                <div class="col-12 col-md-6 my-2">
                    <ol class="breadcrumb dark-link m-0 small justify-content-center justify-content-md-end">
                        <li class="breadcrumb-item">
                            <a class="text-nowrap" href="{{ route('home-page') }}">
                                <i class="fa-sharp fa-regular fa-house"></i>&nbsp;Home /
                            </a>
                        </li>
                        <li class="text-nowrap active" aria-current="page">&nbsp;Sign Up</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-5">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center bg-transparent py-3">
                            <h3 class="h4 mb-0">Sign Up Now</h3>
                            <img class="logo-dark" src="{{ asset('frontend/assets/img/logo.png') }}" title=""
                                alt="" width="120" height="40" />
                            <img class="logo-light" src="{{ asset('frontend/assets/img/logo_light.png') }}" title=""
                                alt="" width="120" height="40" />
                        </div>
                        <div class="card-body">
                            <h4 class="fw-bold mb-3">Sign Up or create account</h4>
                            <form action="{{ route('sign-up-data') }}" method="POST" autocomplete="off">
                                @csrf
                                <div class="mb-3">
                                    <p class="form-label mb-3">Create an account using your mobile number<br>
                                        <strong>{{ $country }} {{ $mobile }}</strong><a
                                            href="{{ route('sign-in') }}"> Change</a>
                                    </p>
                                </div>
                                <input type="hidden" name="country" value="{{ $country }}">
                                <input type="hidden" name="mobile" value="{{ $mobile }}">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Enter your full name">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" name="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Enter your email">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password<span
                                            class="text-danger">*</span></label>
                                    <input type="password" name="password" id="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Enter password" minlength="6">
                                    <span class="text-black small">
                                        <i class="fa-sharp fa-regular fa-triangle-exclamation"></i> Passwords must be at
                                        least 6 characters.
                                    </span>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <span class="text-black small">
                                    To verify your number, we will send you a text message with a temporary code. Message
                                    and data rates may apply.
                                </span>

                                <button type="submit" class="btn btn-primary w-100 mt-3">Verify mobile number</button>

                                <p class="small mt-2 text-center">
                                    Already a customer?
                                    <a href="{{ route('sign-in') }}">Sign in instead</a>
                                </p>

                                <hr>

                                <p class="text-center">
                                    <strong>By creating an account or logging in, you agree to Shahshop</strong><br>
                                    <a href="#">Condition of Use</a> and <a href="#">Privacy Policy</a>.
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
