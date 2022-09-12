@extends('frontend.master')

@section('content')

<!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="index.html">Home</a></li>
            <li>Product Details</li>
        </ul>
    </div>
</div>
<!-- breadcrumb_section - end
================================================== -->

<!-- product_details - start
================================================== -->
<section class="product_details section_space pb-0">
    <div class="container">
        <div class="row">
            <div class="col col-lg-6">
                <div class="product_details_image">
                    <div class="details_image_carousel">
                        @php
                            $product_id = $product_details->first()->id;
                        @endphp
                        @foreach (App\Models\thumbnail::where('product_id',$product_id)->get() as $thumb)
                            <div class="slider_item">
                                <img src="{{ asset('uploads/products/thumbnails/') }}/{{ $thumb->thumbnail }}" alt="image_not_found">
                            </div>
                        @endforeach

                    </div>

                    <div class="details_image_carousel_nav">
                        @foreach (App\Models\thumbnail::where('product_id',$product_id)->get() as $thumb)
                            <div class="slider_item">
                                <img src="{{ asset('uploads/products/thumbnails/') }}/{{ $thumb->thumbnail }}" alt="image_not_found">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @php
                if($product_review->count() == 0){
                    $avrg = 0;
                }
                else {
                    $avrg = round($product_star / $product_review->count());
                }
            @endphp
            <div class="col-lg-6">
                <div class="product_details_content">
                    <h2 class="item_title">{{ $product_details->first()->product_name }}</h2>
                    <p>{{ $product_details->first()->short_desp }}</p>
                    <div class="item_review">
                        <ul class="rating_star ul_li">
                            @for ($i=1; $i <= $avrg; $i++)
                                <li><i class="fas fa-star"></i></li>
                            @endfor
                        </ul>
                        <span class="review_value">{{ $avrg }} Rating(s)</span>
                    </div>

                    <div class="item_price">
                        <span>BDT <span id="price">{{ $product_details->first()->discount_price }}</span></span>
                        @if ($product_details->first()->product_discount != 0)
                            <del>BDT{{ $product_details->first()->product_price }}</del>
                        @endif
                    </div>
                    <hr>
                    <form action="{{ route('cart_store') }}" method="POST">
                        @csrf
                        <input id="product_id" type="hidden" name="product_id" value="{{ $product_details->first()->id }}">
                        <div class="item_attribute">
                            <div class="row">
                                <div class="col col-md-6">
                                    <div class="select_option clearfix">
                                        <h4 class="input_title">Color *</h4>
                                        <select name="color_id" class="niceSelect" id="color_id">
                                            <option value="" data-display="- Please select -">Choose A Option</option>
                                            @foreach ($product_color as $color)
                                                <option value="{{ $color->color_id }}">{{ $color->rel_to_color->color_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col col-md-6">
                                    <div class="select_option clearfix">
                                        <h4 class="input_title">Size *</h4>
                                        <select name="size_id" class="form-control" id="size_id">
                                            <option data-display="- Please select -">Choose A Option</option>
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
                                <input name="quantity" id="quantity" class="input_number" type="text" value="1">
                                <button type="button" class="input_number_increment">
                                    <i class="fal fa-plus"></i>
                                </button>
                            </div>
                            <div class="total_price">Total: <span id="total_price">{{ $product_details->first()->discount_price }}</span> /-</div>
                        </div>

                        @error('color_id')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        @error('size_id')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror

                        @if (session('stock_out'))
                            <div class="alert alert-warning">{{ session('stock_out') }}</div>
                        @endif
                        @if($total_product != 0)
                            @if (Auth::guard('customer')->check() && Auth::guard('customer')->user()->email_verify != null)
                                <ul class="default_btns_group ul_li">
                                    <li><button class="btn btn_primary addtocart_btn" type="submit">Add To Cart</button></li>
                                </ul>
                            @else
                                <ul class="default_btns_group ul_li">
                                    <li style="color:#f02757;"> > You Can Not Add This Product Now ! ( You Must Signin And Verify Your Account For That )</li>
                                </ul>
                            @endif
                        @else
                            <ul class="default_btns_group ul_li">
                                <li><strong class="text-danger">This Product Is Not Available Right Now ! (STOCK OUT)</strong></li>
                            </ul>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <div class="details_information_tab">
            <ul class="tabs_nav nav ul_li" role=tablist>
                <li>
                    <button class="active" data-bs-toggle="tab" data-bs-target="#description_tab" type="button" role="tab" aria-controls="description_tab" aria-selected="true">
                    Description
                    </button>
                </li>
                <li>
                    <button data-bs-toggle="tab" data-bs-target="#reviews_tab" type="button" role="tab" aria-controls="reviews_tab" aria-selected="false">
                    Reviews({{ $product_review->count(); }})
                    </button>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="description_tab" role="tabpanel">
                    {!! $product_details->first()->long_desp !!}
                </div>
                <div class="tab-pane fade" id="reviews_tab" role="tabpanel">
                    <div class="average_area">
                        <div class="row align-items-center">
                            <div class="col-md-12 order-last">
                                <div class="average_rating_text">
                                    <ul class="rating_star ul_li_center">
                                        @for ($i=1; $i <= $avrg; $i++)
                                            <li><i class="fas fa-star"></i></li>
                                        @endfor
                                    </ul>
                                    <p class="mb-0">
                                    Average Star Rating: <span>{{ $avrg }} out of 5</span> ({{ $product_review->count(); }} vote)
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="customer_reviews">
                        <h4 class="reviews_tab_title">{{ $product_review->count(); }} reviews for this product</h4>
                        @foreach ($product_review as $review)
                            <div class="customer_review_item clearfix">
                                <div class="customer_image">
                                    <img src="{{ asset('frontend/assets/images/team/team_1.jpg') }}" alt="image_not_found">
                                </div>
                                <div class="customer_content">
                                    <div class="customer_info">
                                        <ul class="rating_star ul_li">
                                            @for ($i=1; $i <= $review->star; $i++)
                                            <li><i class="fas fa-star"></i></li>
                                            @endfor
                                        </ul>
                                        <h4 class="customer_name">{{ $review->rel_to_customer->name }}</h4>
                                        <span class="comment_date">{{ $review->updated_at->format('d-M-Y') }}</span>
                                    </div>
                                    <p class="mb-0">{{ $review->review }}</p>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    @auth('customer')
                        @if ($order_details->exists())
                            @if ($order_details->whereNull('review')->exists())
                                <div class="customer_review_form">
                                    <h4 class="reviews_tab_title">Add a review</h4>
                                    <form action="{{ route('review_store') }}" method="POST">
                                        @csrf
                                        <div class="form_item">
                                            <label for="" class="form-label">Name</label>
                                            <input type="text" name="name" placeholder="Your name" readonly value="{{ Auth::guard('customer')->user()->name; }}">
                                        </div>
                                        <div class="form_item">
                                            <label for="" class="form-label">Email</label>
                                            <input type="email" name="email" placeholder="Your Email*" readonly value="{{ Auth::guard('customer')->user()->email; }}">
                                        </div>
                                        <div class="your_ratings">
                                            <h5>Your Ratings:</h5>
                                            <span class="star-cb-group">
                                                <input class="star" type="radio" id="rating-5" name="rating" value="5" /><label for="rating-5">5</label>
                                                <input class="star" type="radio" id="rating-4" name="rating" value="4" checked="checked" /><label for="rating-4">4</label>
                                                <input class="star" type="radio" id="rating-3" name="rating" value="3" /><label for="rating-3">3</label>
                                                <input class="star" type="radio" id="rating-2" name="rating" value="2" /><label for="rating-2">2</label>
                                                <input class="star" type="radio" id="rating-1" name="rating" value="1" /><label for="rating-1">1</label>
                                            </span>
                                        </div>
                                        <div class="form_item">
                                            <input type="hidden" name="star" id="star">
                                            <input type="hidden" name="product_id" value="{{ $product_details->first()->id }}">
                                            <textarea name="review" placeholder="Your Review*"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn_primary">Submit Now</button>
                                    </form>
                                </div>
                            @else
                                <h5 style="font-style: italic; color:#052840; font-weight:800;"> >> Thanks For Your Review <span>( {{ Auth::guard('customer')->user()->name; }} )</span> .</h5>
                            @endif
                        @else
                            <h5 style="font-style: italic; color:#052840; font-weight:800;"> >> You Haven't Pruchase This Product Yet !! Please Purchase Before Adding A Review.</h5>
                        @endif
                    @else
                    <h5 style="font-style: italic; color:#052840; font-weight:800;"> >> For Add A Review You Have To Login First !! <a style="text-decoration: underline" class="text-primary" href="{{ route('register_login') }}">Tap here to Login.</a></h5>

                    @endauth

                </div>
            </div>
        </div>
    </div>
</section>
<!-- product_details - end
================================================== -->

<!-- related_products_section - start
================================================== -->
<section class="related_products_section section_space">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="best-selling-products related-product-area">
                    <div class="sec-title-link">
                        <h3>Related products</h3>
                        <div class="view-all"><a href="#">View all<i class="fal fa-long-arrow-right"></i></a></div>
                    </div>
                    <div class="product-area clearfix">
                        @foreach ($related_product as $related)
                            <div class="grid">
                                <div class="product-pic">
                                    <img src="{{ asset('uploads/products/previews') }}/{{ $related->product_preview }}" alt>
                                    <div class="actions">
                                        <ul>
                                            <li>
                                                <a href="#"><svg role="img" xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" viewBox="0 0 24 24" stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Favourite</title> <path d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"/> </svg></a>
                                            </li>
                                            <li>
                                                <a href="#"><svg role="img" xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" viewBox="0 0 24 24" stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Shuffle</title> <path d="M21 16.0399H17.7707C15.8164 16.0399 13.9845 14.9697 12.8611 13.1716L10.7973 9.86831C9.67384 8.07022 7.84196 7 5.88762 7L3 7"/> <path d="M21 7H17.7707C15.8164 7 13.9845 8.18388 12.8611 10.1729L10.7973 13.8271C9.67384 15.8161 7.84196 17 5.88762 17L3 17"/> <path d="M19 4L22 7L19 10"/> <path d="M19 13L22 16L19 19"/> </svg></a>
                                            </li>
                                            <li>
                                                <a class="quickview_btn" data-bs-toggle="modal" href="#quickview_popup" role="button" tabindex="0"><svg width="48px" height="48px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Visible (eye)</title> <path d="M22 12C22 12 19 18 12 18C5 18 2 12 2 12C2 12 5 6 12 6C19 6 22 12 22 12Z"/> <circle cx="12" cy="12" r="3"/> </svg></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="details">
                                    <h4><a href="{{ route('product_details', $related->slug) }}">{{ $related->product_name }}</a></h4>
                                    <p><a href="{{ route('product_details', $related->slug) }}">{{ substr($related->short_desp,0,40) }}...</a></p>
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <span class="price">
                                        <ins>
                                            <span class="woocommerce-Price-amount amount">
                                                <bdi>
                                                    <span class="woocommerce-Price-currencySymbol">BDT</span>{{ $related->discount_price }}
                                                </bdi>
                                            </span>
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
    </div>
</section>
<!-- related_products_section - end
================================================== -->


@endsection


@section('footer_script')
    <script>
        $('#color_id').change(function(){
            let color_id = $('#color_id').val();
            let product_id = $('#product_id').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/get/size',
                type: 'POST',
                data: {'color_id':color_id,'product_id':product_id},
                success: function(data){
                    $('#size_id').html(data);
                }
            })

        })
    </script>

    <script>
        $('.input_number_increment').click(function(){
            let increament = $('#quantity').val();
            let product_price = $('#price').html();
            let total = product_price * increament;

            $('#total_price').html(total);

        })

        $('.input_number_decrement').click(function(){
            let increament = $('#quantity').val();
            if(increament > 0){
                let product_price = $('#price').html();
                let total = product_price * increament;

                $('#total_price').html(total);
            }
            else{
                $('#quantity').val(1)
            }
        })

        $('.star').click(function(){
            let star = $(this).val();
            $('#star').attr('value', star);
        })
    </script>
@endsection
