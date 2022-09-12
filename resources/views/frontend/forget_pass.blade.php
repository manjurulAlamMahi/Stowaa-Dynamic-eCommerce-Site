@extends('frontend.master')

@section('content')
<!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="index.html">Home</a></li>
            <li>Forget/Password</li>
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
                        <h4>Confirm Your Email Where We Will Send A Forget Password Link!</h4>
                    </li>
                    @if (session('request'))
                        <li role="presentation">
                            <p class="text-success">{{ session('request') }}</p>
                        </li>
                    @endif

                </ul>

                <div class="register_wrap tab-content">
                    <div class="tab-pane fade show active" id="signin_tab" role="tabpanel">
                        <form action="{{ route('reset_pass_data_store') }}" method="POST">
                            @csrf
                            <div class="form_item_wrap">
                                <h3 class="input_title">Email*</h3>
                                <div class="form_item">
                                    <label for="username_input"><i class="fas fa-envelope"></i></label>
                                    <input id="username_input" type="text" name="email" placeholder="Email Address">
                                </div>
                                @if (session('error'))
                                    <div class="form-item mb-3">
                                        <strong class="text-danger">{{ session('error') }}</strong>
                                    </div>
                                @endif
                            </div>

                            <div class="form_item_wrap">
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
