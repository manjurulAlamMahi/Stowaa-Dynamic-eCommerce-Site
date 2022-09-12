@extends('frontend.master')

@section('content')
<!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="index.html">Home</a></li>
            <li>Update/Password</li>
        </ul>
    </div>
</div>
<!-- breadcrumb_section - end
================================================== -->
<section class="register_section section_space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <ul class="nav register_tabnav ul_li_center" role="tablist">
                    <li role="presentation">
                        <h4>Please Enter Your New Password!</h4>
                    </li>
                </ul>

                <div class="register_wrap tab-content">
                    <div class="tab-pane fade show active" id="signin_tab" role="tabpanel">
                        <form action="{{ route('update_new_password') }}" method="POST">
                            @csrf
                            <div class="form_item_wrap" style="padding-left: 185px;">
                                <h3 class="input_title">New Password*</h3>
                                <div class="form_item">
                                    <label for="username_input"><i class="fas fa-lock"></i></label>
                                    <input id="username_input" type="password" name="new_password" placeholder="New Password">
                                </div>
                            </div>
                            <div class="form_item_wrap" style="padding-left: 185px;">
                                <h3 style="padding-right: 0" class="input_title">Confirm Password*</h3>
                                <div class="form_item">
                                    <label for="username_input"><i class="fas fa-lock"></i></label>
                                    <input id="username_input" type="password" name="con_password" placeholder="Confirm Password">
                                </div>
                            </div>
                            @if (session('error'))
                                <div class="form_item_wrap mb-3" style="padding-left: 185px;">
                                    <strong class="text-danger">{{ session('error') }}</strong>
                                </div>
                            @endif
                            <div class="form_item_wrap" style="padding-left: 185px;">
                                <input type="hidden" name="token" value="{{ $token }}">
                                <button type="submit" class="btn btn_primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
