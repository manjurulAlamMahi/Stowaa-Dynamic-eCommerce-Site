@extends('frontend.master')

@section('content')
    <!-- slider_section - start
    ================================================== -->
    <section class="slider_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 offset-lg-3">
                    <div class="main_slider" data-slick='{"arrows": false}'>
                        <div class="slider_item set-bg-image" data-background="{{ asset('frontend/assets/images/slider/slide-2.jpg') }}">
                            <div class="slider_content">
                                <h3 class="small_title" data-animation="fadeInUp2" data-delay=".2s">Clothing</h3>
                                <h4 class="big_title" data-animation="fadeInUp2" data-delay=".4s">Smart blood  <span>Pressure monitor</span></h4>
                                <p data-animation="fadeInUp2" data-delay=".6s">The best gadgets collection 2021</p>
                                <div class="item_price" data-animation="fadeInUp2" data-delay=".6s">
                                    <del>$430.00</del>
                                    <span class="sale_price">$350.00</span>
                                </div>
                                <a class="btn btn_primary" href="shop_details.html" data-animation="fadeInUp2" data-delay=".8s">Start Buying</a>
                            </div>
                        </div>
                        <div class="slider_item set-bg-image" data-background="{{ asset('frontend/assets/images/slider/slide-3.jpg') }}">
                            <div class="slider_content">
                                <h3 class="small_title" data-animation="fadeInUp2" data-delay=".2s">Clothing</h3>
                                <h4 class="big_title" data-animation="fadeInUp2" data-delay=".4s">Smart blood  <span>Pressure monitor</span></h4>
                                <p data-animation="fadeInUp2" data-delay=".6s">The best gadgets collection 2021</p>
                                <div class="item_price" data-animation="fadeInUp2" data-delay=".6s">
                                    <del>$430.00</del>
                                    <span class="sale_price">$350.00</span>
                                </div>
                                <a class="btn btn_primary" href="shop_details.html" data-animation="fadeInUp2" data-delay=".8s">Start Buying</a>
                            </div>
                        </div>
                        <div class="slider_item set-bg-image" data-background="{{ asset('frontend/assets/images/slider/slide-1.jpg') }}">
                            <div class="slider_content">
                                <h3 class="small_title" data-animation="fadeInUp2" data-delay=".2s">Clothing</h3>
                                <h4 class="big_title" data-animation="fadeInUp2" data-delay=".4s">Smart blood  <span>Pressure monitor</span></h4>
                                <p data-animation="fadeInUp2" data-delay=".6s">The best gadgets collection 2021</p>
                                <div class="item_price" data-animation="fadeInUp2" data-delay=".6s">
                                    <del>$430.00</del>
                                    <span class="sale_price">$350.00</span>
                                </div>
                                <a class="btn btn_primary" href="shop_details.html" data-animation="fadeInUp2" data-delay=".8s">Start Buying</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- slider_section - end
    ================================================== -->

    <!-- policy_section - start
    ================================================== -->
    <section class="policy_section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="policy-wrap">
                        <div class="policy_item">
                            <div class="item_icon">
                                <i class="icon icon-Truck"></i>
                            </div>
                            <div class="item_content">
                                <h3 class="item_title">Free Shipping</h3>
                                <p>
                                    Free shipping on all US order
                                </p>
                            </div>
                        </div>

                        <div class="policy_item">
                            <div class="item_icon">
                                <i class="icon icon-Headset"></i>
                            </div>
                            <div class="item_content">
                                <h3 class="item_title">Support 24/ 7</h3>
                                <p>
                                    Contact us 24 hours a day
                                </p>
                            </div>
                        </div>

                        <div class="policy_item">
                            <div class="item_icon">
                                <i class="icon icon-Wallet"></i>
                            </div>
                            <div class="item_content">
                                <h3 class="item_title">100% Money Back</h3>
                                <p>
                                    You have 30 days to Return
                                </p>
                            </div>
                        </div>

                        <div class="policy_item">
                            <div class="item_icon">
                                <i class="icon icon-Starship"></i>
                            </div>
                            <div class="item_content">
                                <h3 class="item_title">90 Days Return</h3>
                                <p>
                                    If goods have problems
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- policy_section - end
    ================================================== -->

    <!-- products-with-sidebar-section - start
    ================================================== -->
    <section class="products-with-sidebar-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 order-lg-3">
                    <div class="best-selling-products">
                        <div class="sec-title-link">
                            <h3>Best selling</h3>
                            <div class="view-all"><a href="#">View all<i class="fal fa-long-arrow-right"></i></a></div>
                        </div>
                        <div class="product-area clearfix">
                            @foreach ($best_selling as $best)
                                @foreach (App\Models\Product::where('id', $best->product_id)->latest()->take(6)->get() as $products)
                                    @if (App\Models\inventory::where('product_id' , $best->product_id)->exists())
                                        @php
                                            if($product_review->count() == 0){
                                                $avrg = 0;
                                            }
                                            else {
                                                $avrg = round($product_star / $product_review->count());
                                            }
                                        @endphp
                                        <div class="grid">
                                            <div class="product-pic">
                                                <img src="{{ asset('uploads/products/previews') }}/{{ $products->product_preview }}" alt>
                                                @if ( $products->product_discount != 0)
                                                <span class="theme-badge-2">{{ $products->product_discount }}% off</span>
                                                @endif
                                                <style>
                                                    .wish_hover{
                                                        background: #f02757 !important;
                                                        border-color: #f02757 !important;
                                                    }
                                                    .wish_hover svg{
                                                        stroke: white !important;
                                                    }
                                                </style>
                                                @auth('customer')
                                                <div class="actions">
                                                    <ul>
                                                        <li>
                                                            <a href="{{ route('favourit', $products->id) }}" class="{{ (App\Models\wishlist::where('product_id',$products->id)->where('customer_id' , Auth::guard('customer')->user()->id)->exists()?'wish_hover':'') }}"><svg role="img" xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" viewBox="0 0 24 24"  stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Favourite</title> <path d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"/> </svg></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                @endauth
                                            </div>
                                            <div class="details">
                                                <h4><a href="{{ route('product_details',$products->slug) }}">{{ $products->product_name }}</a></h4>
                                                <p><a href="{{ route('product_details',$products->slug) }}">{{ substr("$products->short_desp", 0 , 80) }}...</a></p>
                                                <div class="rating">
                                                    @for ($i=1; $i <= $avrg; $i++)
                                                        <i class="fas fa-star"></i>
                                                    @endfor
                                                </div>
                                                <span class="price">
                                                    <ins>
                                                        <span class="woocommerce-Price-amount amount">
                                                            <bdi>
                                                                <span class="woocommerce-Price-currencySymbol">BDT</span>{{ $products->discount_price }}
                                                            </bdi>
                                                        </span>
                                                    </ins>
                                                    @if ( $products->product_discount != 0)
                                                    <del aria-hidden="true">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <bdi>
                                                                <span class="woocommerce-Price-currencySymbol">BDT</span>{{ $products->product_price }}
                                                            </bdi>
                                                        </span>
                                                    </del>
                                                    @endif
                                                </span>
                                                <div class="add-cart-area">
                                                    <button class="add-to-cart">Add to cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                    </div>

                    <div class="top_category_wrap">
                        <div class="sec-title-link">
                            <h3>Top categories</h3>
                        </div>
                        <div class="top_category_carousel2" data-slick='{"dots": false}'>
                            @foreach ($all_categories as $category)
                                <div class="slider_item">
                                    <div class="category_boxed">
                                        <a>
                                            <span class="item_image">
                                                <img src="{{ asset('uploads/category') }}/{{ $category->category_img }}" alt="image_not_found">
                                            </span>
                                            <span style="cursor: pointer" data-cbid="{{ $category->id }}" class="item_title">{{ $category->category_name }}</span>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="carousel_nav carousel-nav-top-right">
                            <button type="button" class="tc_left_arrow"><i class="fal fa-long-arrow-alt-left"></i></button>
                            <button type="button" class="tc_right_arrow"><i class="fal fa-long-arrow-alt-right"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 order-lg-9">
                    <div class="product-sidebar">
                        <div class="widget latest_product_carousel">
                            <div class="title_wrap">
                                <h3 class="area_title">Latest Products</h3>
                                <div class="carousel_nav">
                                    <button type="button" class="vs4i_left_arrow"><i class="fal fa-angle-left"></i></button>
                                    <button type="button" class="vs4i_right_arrow"><i class="fal fa-angle-right"></i></button>
                                </div>
                            </div>
                            <div class="vertical_slider_4item" data-slick='{"dots": false}'>
                                @foreach ($all_product as $latest_product)
                                @php
                                    if($product_review->count() == 0){
                                        $avrg = 0;
                                    }
                                    else {
                                        $avrg = round($product_star / $product_review->count());
                                    }
                                @endphp
                                <div class="slider_item">
                                    <div class="small_product_layout">
                                        <a class="item_image" href="{{ route('product_details', $latest_product->slug) }}">
                                            <img src="{{ asset('uploads/products/previews') }}/{{ $latest_product->product_preview }}" alt="image_not_found">
                                        </a>
                                        <div class="item_content">
                                            <h3 class="item_title">
                                                <a href="{{ route('product_details', $latest_product->slug) }}">{{ $latest_product->product_name }}</a>
                                            </h3>
                                            <ul class="rating_star ul_li">
                                                <li>
                                                    @for ($i=1; $i <= $avrg; $i++)
                                                        <i class="fas fa-star"></i>
                                                    @endfor
                                                </li>
                                            </ul>
                                            <div class="item_price">
                                                <span>{{ $latest_product->discount_price }}BDT</span>
                                                @if ( $latest_product->product_discount != 0)
                                                <del>{{ $latest_product->product_price }}BDT</del>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="widget product-add">
                            <div class="product-img">
                                <img src="{{ asset('frontend/assets/images/shop/product_img_10.png') }}" alt>
                            </div>
                            <div class="details">
                                <h4>iPad pro</h4>
                                <p>iPad pro with M1 chipe</p>
                                <a class="btn btn_primary" href="#" >Start Buying</a>
                            </div>
                        </div>
                        <div class="widget audio-widget">
                            <h5>Audio <span>5</span></h5>
                            <ul>
                                <li><a href="#">MI headphone</a></li>
                                <li><a href="#">Bluetooth AirPods</a></li>
                                <li><a href="#">Music system</a></li>
                                <li><a href="#">JBL bar 5.1</a></li>
                                <li><a href="#">Edifier Computer Speaker</a></li>
                                <li><a href="#">Macbook pro</a></li>
                                <li><a href="#">Men's watch</a></li>
                                <li><a href="#">Washing metchin</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end container  -->
    </section>
    <!-- products-with-sidebar-section - end
    ================================================== -->


    <!-- promotion_section - start
    ================================================== -->
    <section class="promotion_section">
        <div class="container">
            <div class="row promotion_banner_wrap">
                <div class="col col-lg-6">
                    <div class="promotion_banner">
                        <div class="item_image">
                            <img src="{{ asset('frontend/assets/images/promotion/banner_img_1.png') }}" alt>
                        </div>
                        <div class="item_content">
                            <h3 class="item_title">Protective sleeves <span>combo.</span></h3>
                            <p>It is a long established fact that a reader will be distracted</p>
                            <a class="btn btn_primary" href="shop_details.html">Shop Now</a>
                        </div>
                    </div>
                </div>

                <div class="col col-lg-6">
                    <div class="promotion_banner">
                        <div class="item_image">
                            <img src="{{ asset('frontend/assets/images/promotion/banner_img_2.png') }}" alt>
                        </div>
                        <div class="item_content">
                            <h3 class="item_title">Nutrillet blender <span>combo.</span></h3>
                            <p>
                                It is a long established fact that a reader will be distracted
                            </p>
                            <a class="btn btn_primary" href="shop_details.html">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- promotion_section - end
    ================================================== -->

    <!-- new_arrivals_section - start
    ================================================== -->
    <section class="new_arrivals_section section_space">
        <div class="container">
            <div class="sec-title-link">
                <h3>New Arrivals</h3>
            </div>

            <div class="row newarrivals_products">
                <div class="col col-lg-5">
                    <div class="deals_product_layout1">
                        <div class="bg_area">
                            <h3 class="item_title">Best <span>Product</span> Deals</h3>
                            <p>
                                Get a 20% Cashback when buying TWS Product From SoundPro Audio Technology.
                            </p>
                            <a class="btn btn_primary" href="shop_details.html">Shop Now</a>
                        </div>
                    </div>
                </div>

                <div class="col col-lg-7">
                    <div class="new-arrivals-grids clearfix">
                        @foreach ($new_arrivals as $new_product)
                            <div class="grid">
                                <div class="product-pic">
                                    <img src="{{ asset('uploads/products/previews') }}/{{ $new_product->product_preview }}" alt>
                                    @if ($new_product->product_discount != 0)
                                    <span class="theme-badge-2">{{ $new_product->product_discount }}% off</span>
                                    @endif
                                    @auth('customer')
                                    <div class="actions">
                                        <ul>
                                            <li>
                                                <a href="{{ route('favourit', $products->id) }}" class="{{ (App\Models\wishlist::where('product_id',$products->id)->where('customer_id' , Auth::guard('customer')->user()->id)->exists()?'wish_hover':'') }}"><svg role="img" xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" viewBox="0 0 24 24"  stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Favourite</title> <path d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"/> </svg></a>
                                            </li>
                                        </ul>
                                    </div>
                                    @endauth
                                </div>
                                <div class="details">
                                    <h4><a href="{{ route('product_details',$new_product->slug) }}">{{ $new_product->product_name }}</a></h4>
                                    <p><a href="{{ route('product_details',$new_product->slug) }}">{{ substr("$new_product->short_desp",0,50) }}...</a></p>
                                    <span class="price">
                                        <ins>
                                            <span class="woocommerce-Price-amount amount">
                                                <bdi>
                                                    <span class="woocommerce-Price-currencySymbol">BDT</span>{{ $new_product->discount_price }}
                                                </bdi>
                                            </span>
                                            @if ($new_product->product_discount != 0)
                                            <del aria-hidden="true">
                                                <span class="woocommerce-Price-amount amount">
                                                    <bdi>
                                                        <span class="woocommerce-Price-currencySymbol">BDT</span>{{ $new_product->product_price }}
                                                    </bdi>
                                                </span>
                                            </del>
                                            @endif
                                        </ins>
                                    </span>
                                    <div class="add-cart-area">
                                        <button class="add-to-cart">Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- new_arrivals_section - end
    ================================================== -->

    <!-- brand_section - start
    ================================================== -->
    <div class="brand_section pb-0">
        <div class="container">
            <div class="brand_carousel">
                <div class="slider_item">
                    <a class="product_brand_logo" href="#!">
                        <img src="{{ asset('frontend/assets/images/brand/brand_1.png') }}" alt="image_not_found">
                        <img src="{{ asset('frontend/assets/images/brand/brand_1.png') }}" alt="image_not_found">
                    </a>
                </div>
                <div class="slider_item">
                    <a class="product_brand_logo" href="#!">
                        <img src="{{ asset('frontend/assets/images/brand/brand_2.png') }}" alt="image_not_found">
                        <img src="{{ asset('frontend/assets/images/brand/brand_2.png') }}" alt="image_not_found">
                    </a>
                </div>
                <div class="slider_item">
                    <a class="product_brand_logo" href="#!">
                        <img src="{{ asset('frontend/assets/images/brand/brand_3.png') }}" alt="image_not_found">
                        <img src="{{ asset('frontend/assets/images/brand/brand_3.png') }}" alt="image_not_found">
                    </a>
                </div>
                <div class="slider_item">
                    <a class="product_brand_logo" href="#!">
                        <img src="{{ asset('frontend/assets/images/brand/brand_4.png') }}" alt="image_not_found">
                        <img src="{{ asset('frontend/assets/images/brand/brand_4.png') }}" alt="image_not_found">
                    </a>
                </div>
                <div class="slider_item">
                    <a class="product_brand_logo" href="#!">
                        <img src="{{ asset('frontend/assets/images/brand/brand_5.png') }}" alt="image_not_found">
                        <img src="{{ asset('frontend/assets/images/brand/brand_5.png') }}" alt="image_not_found">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- brand_section - end
    ================================================== -->

    <!-- viewed_products_section - start
    ================================================== -->
    <section class="viewed_products_section section_space">
        <div class="container">

            <div class="sec-title-link mb-0">
                <h3>Recently Viewed Products</h3>
            </div>

            <div class="viewed_products_wrap arrows_topright">
                <div class="viewed_products_carousel row" data-slick='{"dots": false}'>
                    @foreach ($all_recently_view_product as $all_recent_product)
                        <div class="slider_item col">
                            <div class="viewed_product_item">
                                <div class="item_image">
                                    <img src="{{ asset('uploads/products/previews') }}/{{ $all_recent_product->product_preview }}" alt="image_not_found">
                                </div>
                                <div class="item_content">
                                    <h3 class="item_title">{{ $all_recent_product->product_name }}</h3>
                                    <ul class="ul_li_block">
                                        @foreach (App\Models\subcategory::where('category_id',$all_recent_product->category_id)->take(4)->get() as $subcategory)
                                            <li class="scid" ><a style="cursor: pointer" class="subID" data-subid="{{ $subcategory->id }}" data-csubid="{{ $subcategory->category_id }}">{{ $subcategory->subcategory_name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="carousel_nav">
                    <button type="button" class="vpc_left_arrow"><i class="fal fa-long-arrow-alt-left"></i></button>
                    <button type="button" class="vpc_right_arrow"><i class="fal fa-long-arrow-alt-right"></i></button>
                </div>
            </div>
        </div>
    </section>
    <!-- viewed_products_section - end
    ================================================== -->

@endsection

@section('footer_script')
<script>
let category_boxed = document.querySelectorAll(".category_boxed");

let category_boxed_arr = Array.from(category_boxed);

category_boxed_arr.map(item=>{
    item.addEventListener('click', function(g){

        if(g.target.className == 'item_title'){
            let category_id = g.target.dataset.cbid
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

<script>
let scid = document.querySelectorAll(".scid");

let scid_arr = Array.from(scid);

scid_arr.map(item=>{
    item.addEventListener('click', function(h){

        if(h.target.className == 'subID'){
            let category_id = h.target.dataset.csubid
            let search_subcategory = h.target.dataset.subid
            let search_input = $('#search_input').val();
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
@endsection
