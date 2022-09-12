<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Gymove - Fitness Bootstrap Admin Dashboard</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/images/favicon.png') }}">
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>

<style>
    .background{
        position: relative;
        z-index: 1;
    }
    .background_img{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -2;

    }
    .background::after{
        position: absolute;
        content: '';
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        z-index: -1;
    }
</style>

<body class="h-100">
<div class="background">
    <img class="background_img" src="{{ asset('backend/images/loginregister_background.jpg') }}" alt="">
    <div class="row py-5">
        <div class="col-lg-8 m-auto">
            <div class="auth-form">
                <div class="text-center mb-3">
                    <a href="index.html"><img src="{{ asset('backend/images/logo-full.png') }}" alt=""></a>
                </div>
                <h4 class="text-center mb-4 text-white">Sign up your account</h4>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label class="mb-1 text-white"><strong>Name</strong></label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus type="text" placeholder="your name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="mb-1 text-white"><strong>Email</strong></label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="hello@example.com">
                    </div>
                    <div class="form-group">
                        <label class="mb-1 text-white"><strong>Password</strong></label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" value="Password">
                    </div>
                    <div class="form-group">
                        <label class="mb-1 text-white"><strong>Confirm Password</strong></label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn bg-white text-primary btn-block">{{ __('Register') }}</button>
                    </div>
                </form>
                <div class="new-account mt-3">
                    <p class="text-white">Already have an account? <a class="text-white" href="page-login.html">Sign in</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('backend/vendor/global/global.min.js') }}"></script>
	<script src="{{ asset('backend/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('backend/js/custom.min.js') }}"></script>
    <script src="{{ asset('backend/js/deznav-init.js') }}"></script>

</body>

</html>
