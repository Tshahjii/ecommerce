@extends('frontend.layout.main')
@section('content')
    <div class="header-top bg-primary text-white announcement-bar" style="--ann-speed: 60s;">
        <ul class="announcement-bar-wrap list-unstyled m-0 p-0">
            <li class="announcement-bar-item py-2">NEW SEASON, NEW STYLES: FASHION SALE YOU CAN'T MISS</li>
            <li class="announcement-bar-item py-2">FREE SHIPPING AND RETURNS</li>
            <li class="announcement-bar-item py-2">Contact us 24/7</li>
            <li class="announcement-bar-item py-2">30 Days Return</li>
            <li class="announcement-bar-item py-2">100% Secure Payment</li>
        </ul>
        <ul class="announcement-bar-wrap list-unstyled m-0 p-0">
            <li class="announcement-bar-item py-2">NEW SEASON, NEW STYLES: FASHION SALE YOU CAN'T MISS</li>
            <li class="announcement-bar-item py-2">FREE SHIPPING AND RETURNS</li>
            <li class="announcement-bar-item py-2">Contact us 24/7</li>
            <li class="announcement-bar-item py-2">30 Days Return</li>
            <li class="announcement-bar-item py-2">100% Secure Payment</li>
        </ul>
    </div>
    @include('frontend.site.slider')
    @include('frontend.site.section1')
    @include('frontend.site.section2')
    @include('frontend.site.section3')
    @include('frontend.site.section4')
    @include('frontend.site.section5')
    @include('frontend.site.section6')
    @include('frontend.site.section7')
    @include('frontend.site.latest-collection')
    @include('frontend.site.section8')
    @include('frontend.site.section9')
    @include('frontend.site.section10')
    @include('frontend.site.section11')
    @include('frontend.site.section12')
    @include('frontend.site.section13')
    @include('frontend.site.blog')
@endsection
@section('title')
    Home Page
@endsection
