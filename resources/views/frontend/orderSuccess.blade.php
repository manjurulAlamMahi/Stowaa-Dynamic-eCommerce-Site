@extends('frontend.master')

@section('content')

<!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="index.html">Home</a></li>
            <li>Order Confirm</li>
        </ul>
    </div>
</div>
<!-- breadcrumb_section - end
================================================== -->

<!-- empty_cart_section - start
================================================== -->
<section class="empty_cart_section section_space">
    <div class="container">
        <div class="empty_cart_content text-center">
            <span class="cart_icon">
                <i class="far fa-smile"></i>
            </span>
            <h3>Thank you <b>"{{  Auth::guard('customer')->user()->name; }}"</b> for purchasing our product.</h3>
            <a class="btn btn_secondary" href="{{ route('frontend') }}"><i class="far fa-chevron-left"></i>Back To Home Page</a>
        </div>
    </div>
</section>
<!-- empty_cart_section - end
================================================== -->

@endsection
