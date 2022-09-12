<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Stowaa -  Ecommerce HTML Template</title>
    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/logo/favourite_icon_1.png') }}">

    <!-- fraimwork - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">

    <!-- icon font - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/stroke-gap-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/icofont.css') }}">

    <!-- animation - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/animate.css') }}">

    <!-- carousel - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/slick-theme.css') }}">

    <!-- popup - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/magnific-popup.css') }}">

    <!-- jquery-ui - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/jquery-ui.css') }}">

    <!-- select option - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/nice-select.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/woocommerce-2.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @if (!Route::currentRouteName() == 'checkout')
        <!-- woocommercen - css include -->
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/woocommerce.css') }}">
    @endif

    <!-- custom - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/style.css') }}">
</head>

<body>

    <!-- body_wrap - start -->
    <div class="body_wrap">

        <!-- backtotop - start -->
        <div class="backtotop">
            <a href="#" class="scroll">
                <i class="far fa-arrow-up"></i>
            </a>
        </div>
        <!-- backtotop - end -->

        <!-- preloader - start -->
        {{-- <div id="preloader"></div> --}}
        <!-- preloader - end -->

        @if (Auth::guard('customer')->check() && Auth::guard('customer')->user()->email_verify == null)
        <section class="alert-warning" style="padding: 7px 0;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <strong>!! PLease Verify Your Account For Purchasing Our Product !!</strong>
                    </div>
                    <div class="col-lg-6">
                        <strong class="float-end">Didn't Get Verification Link? >> <a href="{{ route('account') }}">Click Here To Get Link.</a></strong>
                    </div>
                </div>
            </div>
        </section>
        @endif

        <!-- header_section - start
        ================================================== -->
        <header class="header_section {{ (Route::currentRouteName() == 'frontend'?'header-style-no-collapse':'header-style-3') }} ">
            <div class="header_top">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col col-md-6">
                            <ul class="header_select_options ul_li">
                                <li>
                                    <div class="select_option">
                                        <div class="flug_wrap">
                                            <img src="{{ asset('frontend/assets/images/flug/flug_uk.png') }}" alt="image_not_found">
                                        </div>
                                        <select class="niceSelect">
                                            <option data-display="Select Option">Select Your Language</option>
                                            <option value="1" selected>English</option>
                                            <option value="2">Bangla</option>
                                            <option value="3" disabled>Arabic</option>
                                            <option value="4">Hebrew</option>
                                        </select>
                                    </div>
                                </li>

                            </ul>
                        </div>
                        <div class="col col-md-6">
                            <p class="header_hotline">Call us toll free: <strong>+1888 234 5678</strong></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header_middle">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col col-lg-3 col-md-3 col-sm-12">
                            <div class="brand_logo">
                                <a class="brand_link" href="index.html">
                                    <img src="{{ asset('frontend/assets/images/logo/logo_1x.png') }}" srcset="{{ asset('frontend/assets/images/logo/logo_2x.png 2x') }}" alt>
                                </a>
                            </div>
                        </div>
                        <div class="col col-lg-6 col-md-6 col-sm-12">
                            <div class="advance_serach">
                                <div class="select_option mb-0 clearfix">
                                    <select id="search_category" class="niceSelect">
                                        <option value="" data-display="All Categories">All Categories</option>
                                        @foreach (App\Models\category::all() as $category)
                                            <option
                                            @if (isset($_GET['c']))
                                                @if ($_GET['c'] == $category->id)
                                                    Selected
                                                @endif
                                            @endif
                                             value="{{ $category->id }}">{{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form_item">
                                    <input type="search" id="search_input" name="search" placeholder="Search Prudcts...">
                                    <button type="submit" class="search_btn"><i class="far fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col col-lg-3 col-md-3 col-sm-12">
                            <button class="mobile_menu_btn2 navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_menu_dropdown" aria-controls="main_menu_dropdown" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fal fa-bars"></i>
                            </button>
                            <button style="float: right;" type="button">
                               <ul class="header_icons_group ul_li_right">
                                    @if (Auth::guard('customer')->check())
                                    <li>
                                        <a href="{{ route('wishlist') }}">
                                            <svg role="img" xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24" stroke="#051d43" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Favourite</title> <path d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"/> </svg>
                                            <span class="wishlist_counter">{{ App\Models\wishlist::where('customer_id', Auth::guard('customer')->id())->count() }}</span>
                                        </a>
                                    </li>
                                    @endif
                                    <li class="cart_btn">
                                        <span class="cart_icon">
                                            <i class="icon icon-ShoppingCart"></i>
                                            <small class="cart_counter">{{ App\Models\cart::where('customer_id', Auth::guard('customer')->id())->count() }}</small>
                                        </span>
                                    </li>
                               </ul>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header_bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col col-md-3">
                            <div class="allcategories_dropdown">
                                <button class="allcategories_btn" type="button" data-bs-toggle="collapse" data-bs-target="#allcategories_collapse" aria-expanded="false" aria-controls="allcategories_collapse">
                                    <svg role="img" xmlns="http://www.w3.org/2000/svg" width="32px" height="32px" viewBox="0 0 24 24" aria-labelledby="statsIconTitle" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none" color="#000"> <title id="statsIconTitle">Stats</title> <path d="M6 7L15 7M6 12L18 12M6 17L12 17"/> </svg>
                                    Browse categories
                                </button>
                                <div class="allcategories_collapse {{ (Route::currentRouteName() == 'frontend'?'':'collapse') }}" id="allcategories_collapse">
                                    <div class="card card-body">
                                        <ul class="allcategories_list ul_li_block">
                                            @foreach (App\Models\category::all() as $category)
                                                <li class="cate"><a style="cursor: pointer;" class="browse_cate" data-bcid="{{ $category->id }}"><i class="{{ $category->category_icon }}"></i> {{ $category->category_name }} </a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col col-md-6">
                            <nav class="main_menu navbar navbar-expand-lg">
                                <div class="main_menu_inner collapse navbar-collapse" id="main_menu_dropdown">
                                    <button type="button" class="offcanvas_close">
                                        <i class="fal fa-times"></i>
                                    </button>
                                    <ul class="main_menu_list ul_li">
                                        <li><a class="nav-link" href="{{ route('frontend') }}">Home</a></li>
                                        <li><a class="nav-link" href="{{ route('about_us') }}">About us</a></li>
                                        <li><a class="nav-link" href="{{ route('shop') }}">Shop</a></li>
                                        <li><a class="nav-link" href="{{ route('contact_us') }}">Contact Us</a></li>
                                    </ul>
                                </div>
                            </nav>
                            <div class="offcanvas_overlay"></div>
                        </div>

                        <div class="col col-md-3">
                            <ul class="header_icons_group ul_li_right">
                                @if (Auth::guard('customer')->check())
                                    <li>
                                        <a style="cursor: pointer" class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::guard('customer')->user()->name; }}</a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item" href="{{ route('account') }}">My Account</a></li>
                                            <li><a class="dropdown-item" href="{{ route('customer_logout') }}">Log Out</a></li>
                                        </ul>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ route('register_login') }}">Register/Sign In</a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ route('account') }}">
                                        <svg role="img" xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24" stroke="#051d43" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title id="personIconTitle">Person</title> <path d="M4,20 C4,17 8,17 10,15 C11,14 8,14 8,9 C8,5.667 9.333,4 12,4 C14.667,4 16,5.667 16,9 C16,14 13,14 14,15 C16,17 20,17 20,20"/> </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- header_section - end
        ================================================== -->

        <!-- main body - start
        ================================================== -->
        <main>

            <!-- sidebar cart - start
            ================================================== -->
            <div class="sidebar-menu-wrapper">
                <div class="cart_sidebar">
                    <button type="button" class="close_btn"><i class="fal fa-times"></i></button>
                    <ul class="cart_items_list ul_li_block mb_30 clearfix">
                        @php
                            $subtotal = 0;
                        @endphp
                        @if (App\Models\cart::where('customer_id', Auth::guard('customer')->id())->count() != 0)
                        @forelse (App\Models\cart::where('customer_id', Auth::guard('customer')->id())->get() as $carts)
                            <li>
                                <div class="item_image">
                                    <img src="{{ asset('uploads/products/previews') }}/{{ $carts->rel_to_product->product_preview }}" alt="image_not_found">
                                </div>
                                <div class="item_content">
                                    <h4 class="item_title">{{ $carts->rel_to_product->product_name }}</h4>
                                    <span class="item_price">BDT {{ $carts->rel_to_product->discount_price }} x {{ $carts->quantity }}</span>
                                    <span>Color : <span class="text-dark">{{ $carts->rel_to_color->color_name }} </span>| Size : <span class="text-dark">{{ $carts->rel_to_size->size_name }} </span></span>
                                </div>
                                <a href="{{ route('cart_remove', $carts->id) }}" class="remove_btn"><i class="fal fa-trash-alt"></i></a>
                            </li>
                            @php
                                $subtotal += $carts->rel_to_product->discount_price * $carts->quantity;
                            @endphp
                            @empty
                            <li>
                                <div class="w-100 alert alert-info">No Product added yet!</div>
                            </li>
                        @endforelse
                        @else
                            <li>
                                <div class="w-100 alert alert-info">No Product added yet!</div>
                            </li>
                        @endif
                    </ul>
                    @if (App\Models\cart::where('customer_id', Auth::guard('customer')->id())->count() != 0)
                        <ul class="total_price ul_li_block mb_30 clearfix">
                            <li>
                                <span>Subtotal:</span>
                                <span>BDT <span>{{ $subtotal }}</span></span>
                            </li>
                        </ul>
                    @endif

                    @if (App\Models\cart::where('customer_id', Auth::guard('customer')->id())->count() != 0)
                        <ul class="btns_group ul_li_block clearfix">
                            <li><a class="btn btn_primary" href="{{ route('cart.html') }}">View Cart</a></li>
                            <li><a class="btn btn_secondary" href="checkout.html">Checkout</a></li>
                        </ul>
                    @else
                        <ul class="btns_group ul_li_block clearfix">
                            <li><a class="btn btn_primary" href="#">Shop Now</a></li>
                        </ul>
                    @endif


                </div>

                <div class="cart_overlay"></div>
            </div>
            <!-- sidebar cart - end
            ================================================== -->


            <!-- product quick view modal - start
            ================================================== -->
            <div class="modal fade" id="quickview_popup" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel2">Product Quick View</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="product_details">
                                <div class="container">
                                    <div class="row">
                                        <div class="col col-lg-6">
                                            <div class="product_details_image p-0">
                                                <img src="{{ asset('frontend/assets/images/shop/product_img_12.png') }}" alt>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="product_details_content">
                                                <h2 class="item_title">CURREN 8109 Watches</h2>
                                                <p>It is a long established fact that a reader will be distracted eget velit. Donec ac tempus ante. Fusce ultricies massa massa. Fusce aliquam, purus eget sagittis vulputate</p>
                                                <div class="item_review">
                                                    <ul class="rating_star ul_li">
                                                        <li><i class="fas fa-star"></i>></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star-half-alt"></i></li>
                                                    </ul>
                                                    <span class="review_value">3 Rating(s)</span>
                                                </div>

                                                <div class="item_price">
                                                    <span>$620.00</span>
                                                    <del>$720.00</del>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="item_attribute">
                                                <div class="row">
                                                    <div class="col col-md-6">
                                                        <div class="select_option clearfix">
                                                            <h4 class="input_title">Size *</h4>
                                                            <select class="niceSelect">
                                                                <option data-display="- Please select -">Choose A Option</option>
                                                                <option value="1">Some option</option>
                                                                <option value="2">Another option</option>
                                                                <option value="3" disabled>A disabled option</option>
                                                                <option value="4">Potato</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col col-md-6">
                                                        <div class="select_option clearfix">
                                                            <h4 class="input_title">Color *</h4>
                                                            <select class="niceSelect">
                                                                <option data-display="- Please select -">Choose A Option</option>
                                                                <option value="1">Some option</option>
                                                                <option value="2">Another option</option>
                                                                <option value="3" disabled>A disabled option</option>
                                                                <option value="4">Potato</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="quantity_wrap">
                                                <div class="quantity_input">
                                                    <button type="button" class="input_number_decrement">
                                                        <i class="fal fa-minus"></i>
                                                    </button>
                                                    <input class="input_number" type="text" value="1">
                                                    <button type="button" class="input_number_increment">
                                                        <i class="fal fa-plus"></i>
                                                    </button>
                                                </div>
                                                <div class="total_price">Total: $620,99</div>
                                            </div>

                                            <ul class="default_btns_group ul_li">
                                                <li><a class="btn btn_primary addtocart_btn" href="#!">Add To Cart</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- product quick view modal - end
            ================================================== -->

            @yield('content')

            <!-- newsletter_section - start
            ================================================== -->
            <section class="newsletter_section">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col col-lg-6">
                            <h2 class="newsletter_title text-white">Sign Up for Newsletter </h2>
                            <p>Get E-mail updates about our latest products and special offers.</p>
                        </div>
                        <div class="col col-lg-6">
                            <form action="#!">
                                <div class="newsletter_form">
                                    <input type="email" name="email" placeholder="Enter your email address">
                                    <button type="submit" class="btn btn_secondary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!-- newsletter_section - end
            ================================================== -->

        </main>
        <!-- main body - end
        ================================================== -->

        <!-- footer_section - start
        ================================================== -->
        <footer class="footer_section">
            <div class="footer_widget_area">
                <div class="container">
                    <div class="row">
                        <div class="col col-lg-4 col-md-6 col-sm-6">
                            <div class="footer_widget footer_about">
                                <div class="brand_logo">
                                    <a class="brand_link" href="index.html">
                                        <img src="{{ asset('frontend/assets/images/logo/logo_1x.png') }}" srcset="{{ asset('frontend/assets/images/logo/logo_2x.png 2x') }}" alt="logo_not_found">
                                    </a>
                                </div>
                                <ul class="social_round ul_li">
                                    <li><a href="#!"><i class="icofont-youtube-play"></i></a></li>
                                    <li><a href="#!"><i class="icofont-instagram"></i></a></li>
                                    <li><a href="#!"><i class="icofont-twitter"></i></a></li>
                                    <li><a href="#!"><i class="icofont-facebook"></i></a></li>
                                    <li><a href="#!"><i class="icofont-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col col-lg-2 col-md-3 col-sm-6">
                            <div class="footer_widget footer_useful_links">
                                <h3 class="footer_widget_title text-uppercase">Quick Links</h3>
                                <ul class="ul_li_block">
                                    <li><a href="about.html">About Us</a></li>
                                    <li><a href="contact.html">Contact Us</a></li>
                                    <li><a href="shop.html">Products</a></li>
                                    <li><a href="login.html">Login</a></li>
                                    <li><a href="register.html">Sign Up</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col col-lg-2 col-md-3 col-sm-6">
                            <div class="footer_widget footer_useful_links">
                                <h3 class="footer_widget_title text-uppercase">Custom area</h3>
                                <ul class="ul_li_block">
                                    <li><a href="#!">My Account</a></li>
                                    <li><a href="#!">Orders</a></li>
                                    <li><a href="#!">Team</a></li>
                                    <li><a href="#!">Privacy Policy</a></li>
                                    <li><a href="#!">My Cart</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col col-lg-4 col-md-6 col-sm-6">
                            <div class="footer_widget footer_contact">
                                <h3 class="footer_widget_title text-uppercase">Contact Onfo</h3>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
                                </p>
                                <div class="hotline_wrap">
                                    <div class="footer_hotline">
                                        <div class="item_icon">
                                            <i class="icofont-headphone-alt"></i>
                                        </div>
                                        <div class="item_content">
                                            <h4 class="item_title">Have any question?</h4>
                                            <span class="hotline_number">+ 123 456 7890</span>
                                        </div>
                                    </div>
                                    <div class="livechat_btn clearfix">
                                        <a class="btn border_primary" href="#">Live Chat</a>
                                    </div>
                                </div>
                                <ul class="store_btns_group ul_li">
                                    <li><a href="#!"><img src="{{ asset('frontend/assets/images/app_store.png') }}" alt="app_store"></a></li>
                                    <li><a href="#!"><img src="{{ asset('frontend/assets/images/play_store.png') }}" alt="play_store"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer_bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col col-md-6">
                            <p class="copyright_text">
                                ©2021 <a href="#!">stowaa</a>. All Rights Reserved.
                            </p>
                        </div>

                        <div class="col col-md-6">
                            <div class="payment_method">
                                <h4>Payment:</h4>
                                <img src="{{ asset('frontend/assets/images/payments_icon.png') }}" alt="image_not_found">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer_section - end
        ================================================== -->

    </div>
    <!-- body_wrap - end -->

    <!-- fraimwork - jquery include -->
    <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>

    <!-- carousel - jquery plugins collection -->
    <script src="{{ asset('frontend/assets/js/jquery-plugins-collection.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- google map  -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDk2HrmqE4sWSei0XdKGbOMOHN3Mm2Bf-M&ver=2.1.6"></script>
    <script src="assets/js/gmaps.min.js"></script>

    <!-- custom - main-js -->
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>

    <script>
        $('.search_btn').click(function(c){
            let search_input = $('#search_input').val();
            let search_category = $('#search_category').val();
            let search_subcategory = $('#subcategory_id').val();
            let min_price = 0;
            let max_price = 1000000;
            let sort_by = $('#sort_by').val();
            let size = $('input[id="size_id"]:checked').val();
            let color = $('input[id="color_id"]:checked').val();
            let url = "{{ route('shop') }}?"+"q="+search_input+"&c="+search_category+"&sc="+search_subcategory+"&sz="+size+"&clr="+color+"&min="+min_price+"&max="+max_price+"&sb="+sort_by;
            window.location.href = url;
        })
    </script>

    <script>
        let cate = document.querySelectorAll(".cate");

        let cate_arr = Array.from(cate);

        cate_arr.map(item=>{
            item.addEventListener('click', function(f){

                if(f.target.className == 'browse_cate'){
                    let category_id = f.target.dataset.bcid
                    let search_input = $('#search_input').val();
                    let search_subcategory = $('#subcategory_id').val();
                    let min_price = 0;
                    let max_price = 1000000;
                    let sort_by = $('#sort_by').val();
                    let size = $('input[id="size_id"]:checked').val();
                    let color = $('input[id="color_id"]:checked').val();
                    let url = "{{ route('shop') }}?"+"q="+search_input+"&c="+category_id+"&sc="+search_subcategory+"&sz="+size+"&clr="+color+"&min="+min_price+"&max="+max_price+"&sb="+sort_by;
                    window.location.href = url;
                }
            })
        });
    </script>

    @yield('footer_script')

</body>
</html>
