@extends('frontend.master')

@section('content')

<!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="index.html">Home</a></li>
            <li>Login/Register</li>
        </ul>
    </div>
</div>
<!-- breadcrumb_section - end
================================================== -->

<!-- register_section - start
================================================== -->
<section class="register_section section_space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <ul class="nav register_tabnav ul_li_center" role="tablist">
                    <li role="presentation">
                        <button class="active" data-bs-toggle="tab" data-bs-target="#signin_tab" type="button" role="tab" aria-controls="signin_tab" aria-selected="true">Sign In</button>
                    </li>
                    <li role="presentation">
                        <button data-bs-toggle="tab" data-bs-target="#signup_tab" type="button" role="tab" aria-controls="signup_tab" aria-selected="false">Register</button>
                    </li>
                </ul>

                @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $err)
                        {{ $err }} <br>
                    @endforeach
                </div>
                @endif

                <div class="register_wrap tab-content">
                    <div class="tab-pane fade show active" id="signin_tab" role="tabpanel">
                        @if (session('login_error'))
                            <div class="alert alert-danger">
                                {{ session('login_error') }}
                            </div>
                        @endif
                        <form action="{{ route('customer_login') }}" method="POST">
                            @csrf
                            <div class="form_item_wrap">
                                <h3 class="input_title">Email*</h3>
                                <div class="form_item">
                                    <label for="username_input"><i class="fas fa-envelope"></i></label>
                                    <input id="username_input" type="text" name="email" placeholder="Email Address"
                                    value="{{ (session('email')?session('email'):'') }}">
                                </div>
                            </div>

                            <div class="form_item_wrap">
                                <h3 class="input_title">Password*</h3>
                                <div class="form_item">
                                    <label for="password_input"><i class="fas fa-lock"></i></label>
                                    <input id="password_input" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="form_item">
                                    <a href="{{ route('forget_pass') }}" id="f_pass" style="color: #abafb3; font-size: 15px;">Forgot your password ?</a>
                                    <style>
                                        #f_pass:hover{
                                            text-decoration: underline;
                                            color: #464a53 !important;
                                        }
                                    </style>
                                </div>
                            </div>

                            <div class="form_item_wrap">
                                <button type="submit" class="btn btn_primary">Sign In</button>
                            </div>

                            <style>
                                .social_login{
                                    text-align: center;
                                    margin: 10px 0;
                                }
                                .social_login p{
                                    text-align: center;
                                    font-size: 16px;
                                    font-weight: 500;
                                    color: #666;
                                    margin: 20px 0;
                                }
                                .social_login ul{
                                    padding: 0;
                                    margin: 0;
                                }
                                .social_login ul li{
                                    list-style: none;
                                }
                                .social_login ul li a{
                                    width: 32px;
                                    height: 32px;
                                    line-height: 28px;
                                    border: 2px solid #ccc;
                                        border-top-color: rgb(204, 204, 204);
                                        border-right-color: rgb(204, 204, 204);
                                        border-bottom-color: rgb(204, 204, 204);
                                        border-left-color: rgb(204, 204, 204);
                                    border-radius: 50%;
                                    text-align: center;
                                    color: #ccc;
                                    margin: 0 5px;
                                }
                                .social_login ul li a.moadl_f{
                                    color: #1b4f9b;
                                    border-color: #1b4f9b;
                                }
                                .social_login ul li a.moadl_f:hover{
                                    background-color: #1b4f9b;
                                    color: #fff;
                                }
                                .social_login ul li a.moadl_t{
                                    color: #6d28d9;
                                    border-color: #6d28d9;
                                }
                                .social_login ul li a.moadl_t:hover{
                                    background-color: #6d28d9;
                                    color: #fff;
                                }
                                .social_login ul li a.moadl_i{
                                    border-color: #dd4b39;
                                    color: #dd4b39;
                                }
                                .social_login ul li a.moadl_i:hover{
                                    background-color: #dd4b39;
                                    color: #fff;
                                }
                            </style>

                            <div class="social_login">
                                <p>Sign In With Social Account</p>
                                <ul class="d-flex justify-content-lg-center">
                                    <li><a href="#" class="moadl_f"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="{{ route('github_redirect') }}" class="moadl_t"><i class="fab fa-github"></i></a></li>
                                    <li><a href="{{  route('google_redirect')  }}" class="moadl_i"><i class="fab fa-google"></i></a></li>
                                </ul>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="signup_tab" role="tabpanel">
                        <form action="{{ route('customer_register') }}" method="POST">
                            @csrf
                            <div class="form_item_wrap">
                                <h3 class="input_title">User Name*</h3>
                                <div class="form_item">
                                    <label for="username_input2"><i class="fas fa-user"></i></label>
                                    <input id="username_input2" type="text" name="username" placeholder="User Name">
                                </div>
                            </div>

                            <div class="form_item_wrap">
                                <h3 class="input_title">Password*</h3>
                                <div class="form_item">
                                    <label for="password_input2"><i class="fas fa-lock"></i></label>
                                    <input id="password_input2" type="password" name="password" placeholder="Password">
                                </div>
                            </div>

                            <div class="form_item_wrap">
                                <h3 class="input_title">Email*</h3>
                                <div class="form_item">
                                    <label for="email_input"><i class="fas fa-envelope"></i></label>
                                    <input id="email_input" type="email" name="email" placeholder="Email">
                                </div>
                            </div>

                            <div class="form_item_wrap">
                                <button type="submit" class="btn btn_secondary">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- register_section - end
================================================== -->

@endsection
