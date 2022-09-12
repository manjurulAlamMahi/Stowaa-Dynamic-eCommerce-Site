@extends('frontend.master')

@section('content')
<!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="index.html">Home</a></li>
            <li>Cart</li>
        </ul>
    </div>
</div>
<!-- breadcrumb_section - end
================================================== -->
@if($cart->count() > 0)
<!-- cart_section - start
================================================== -->
<section class="cart_section section_space">
    <div class="container">
        <div class="cart_table">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Details</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $carts)
                        <tr>
                            <td>
                                <div class="cart_product">
                                    <img src="{{ asset('uploads/products/previews') }}/{{ $carts->rel_to_product->product_preview }}" alt="image_not_found">
                                    <h3><a href="shop_details.html">{{ $carts->rel_to_product->product_name }}</a></h3>
                                </div>
                            </td>
                            <td>
                                <div class="cart_product_details">
                                    <p>Size : <span class="text-primary">{{ $carts->rel_to_size->size_name }}</span></p>
                                    <p>Color : <span style="color: #{{ $carts->rel_to_color->color_code }}">{{ $carts->rel_to_color->color_name }}</span><p>
                                </div>
                            </td>
                            <td class="text-center abc"><span class="price_text">BDT {{ $carts->rel_to_product->discount_price }}</span></td>

                            <form action="{{ route('quanity_update') }}" method="POST"><!-- Quantity Update Form -->
                                @csrf
                            <td class="text-center abc">
                                <div class="quantity_input">
                                    <button type="button" class="input_number_decrement">
                                        <i data-price="{{ $carts->rel_to_product->discount_price }}" class="fal fa-minus"></i>
                                    </button>
                                    <input class="quantity" name="quantity[{{ $carts->id }}]" type="text" value="{{ $carts->quantity }}" />
                                    <button type="button" class="input_number_increment">
                                        <i data-price="{{ $carts->rel_to_product->discount_price }}" class="fal fa-plus"></i>
                                    </button>
                                </div>
                            </td>
                            <td class="text-center abc"><span class="price_text">{{ $carts->rel_to_product->discount_price * $carts->quantity }}</span></td>
                            <td class="text-center"><a href="{{ route('cart_remove', $carts->id) }}" class="remove_btn"><i class="fal fa-trash-alt"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="cart_btns_wrap">
            <div class="row">
                <div class="col col-lg-6 align-self-center">
                    <div class="brand_logo">
                        <a class="brand_link" href="index.html">
                            <img src="{{ asset('frontend/assets/images/logo/logo_1x.png') }}" srcset="{{ asset('frontend/assets/images/logo/logo_2x.png 2x') }}" alt>
                        </a>
                    </div>
                </div>
                <div class="col col-lg-6">
                    @php
                        session([
                            'discount' => $discount,
                            'type' => $type,
                        ]);
                    @endphp
                    <ul class="btns_group ul_li_right">
                        <li><button class="btn border_black" type="submit">Update Cart</button></li>
                        </form><!-- Quantity Update Form -->
                        <li><a class="btn btn_dark" href="{{ route('checkout') }}">Prceed To Checkout</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col col-lg-6">
                <div class="cart_total_table">
                    <h3 class="wrap_title">Cart Totals</h3>
                    <ul class="ul_li_block">
                        <li>
                            <span>Cart Subtotal</span>
                            <span>{{ $subtotal }} BDT</span>
                        </li>
                        <li>
                            <span>Coupon Discount</span>
                            <span>{{ $discount }} {{ ($type == 1?'%':'BDT') }}</span>
                        </li>
                        <li>
                            <span>Order Total</span>
                            <span class="total_price">{{ ($type == 1?$subtotal - ($subtotal*$discount)/100:$subtotal - $discount) }} BDT</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col col-lg-6 align-self-center">
                <form action="{{ route('cart.html') }}" method="GET">
                    <div class="coupon_form form_item mb-0">
                        <input type="text" name="coupon" value="{{ @$_GET['coupon']; }}" placeholder="Coupon Code...">
                        <button type="submit" class="btn btn_dark">Apply Coupon</button>
                        <div class="info_icon">
                            <i class="fas fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Your Info Here"></i>
                        </div>
                    </div>
                    @if ($msg)
                        <div class="alert alert-danger mt-3">
                            {{ $msg }}
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</section>
<!-- cart_section - end
================================================== -->
@else
<!-- empty_cart_section - start
================================================== -->
<section class="empty_cart_section section_space">
    <div class="container">
        <div class="empty_cart_content text-center">
            <span class="cart_icon">
                <i class="icon icon-ShoppingCart"></i>
            </span>
            <h3>There are no more items in your cart</h3>
            <a class="btn btn_secondary" href="index.http"><i class="far fa-chevron-left"></i> Continue shopping </a>
        </div>
    </div>
</section>
<!-- empty_cart_section - end
================================================== -->
@endif



@endsection

@section('footer_script')
    <script>

        let quantity_arr = document.querySelectorAll('.abc');
        let arr = Array.from(quantity_arr);

        arr.map(item=>{
            item.addEventListener('click', function(e){

                if(e.target.className == 'fal fa-plus'){
                    e.target.parentElement.previousElementSibling.value++
                    let quantity = e.target.parentElement.previousElementSibling.value
                    let price = e.target.dataset.price
                    item.nextElementSibling.innerHTML = price*quantity
                }

                if(e.target.parentElement.nextElementSibling.value > 1){
                    if(e.target.className == 'fal fa-minus')
                    {
                        e.target.parentElement.nextElementSibling.value--
                        let quantity = e.target.parentElement.nextElementSibling.value
                        let price = e.target.dataset.price
                        item.nextElementSibling.innerHTML = price*quantity
                    }
                }
            })
        });

    </script>
@endsection
