@extends('frontend.master')

@section('content')
<!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="index.html">Home</a></li>
            <li>Check Out</li>
        </ul>
    </div>
</div>
<!-- breadcrumb_section - end
================================================== -->

<style>
    .select2-container--default .select2-selection--single {
        border: 1px solid #ddd;
        border-radius: 0;
        height: 43px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 43px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px;
    }
</style>

<!-- checkout-section - start
================================================== -->
<section class="checkout-section section_space">
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <div class="woocommerce bg-light p-3">
                    <form name="checkout" method="post" class="checkout woocommerce-checkout" action="{{ route('order_store') }}">
                        @csrf
                        <div class="col2-set" id="customer_details">
                            <div class="coll-1">
                            <div class="woocommerce-billing-fields">
                                <h3>Billing Details</h3>
                                <p class="form-row form-row form-row-first validate-required" id="billing_first_name_field">
                                    <label for="billing_first_name" class="">First Name <abbr class="required" title="required">*</abbr></label>
                                    <input type="text" class="input-text " name="name" id="billing_first_name" placeholder="" autocomplete="given-name" value="{{ Auth::guard('customer')->user()->user_name }}" />
                                </p>
                                <p class="form-row form-row form-row-last validate-required validate-email" id="billing_email_field">
                                    <label for="billing_email" class="">Email Address <abbr class="required" title="required">*</abbr></label>
                                    <input type="email" class="input-text " name="email" id="billing_email" placeholder="" autocomplete="email" value="{{ Auth::guard('customer')->user()->email }}" />
                                </p>
                                <div class="clear"></div>
                                <p class="form-row form-row form-row-first" id="billing_company_field">
                                    <label for="billing_company" class="">Company Name</label>
                                    <input type="text" class="input-text " name="company" id="billing_company" placeholder="" autocomplete="organization" value="" />
                                </p>

                                <p class="form-row form-row form-row-last validate-required validate-phone" id="billing_phone_field">
                                    <label for="billing_phone" class="">Phone <abbr class="required" title="required">*</abbr></label>
                                    <input type="tel" class="input-text " name="number" id="billing_phone" placeholder="" autocomplete="tel" value="" />
                                </p>
                                <div class="clear"></div>
                                <p class="form-row form-row form-row-first address-field update_totals_on_change validate-required" id="billing_country_field">
                                    <label for="city_district" class="">District <abbr class="required" title="required">*</abbr></label>
                                    <select name="district" id="city_district" autocomplete="country" class="country_to_state country_select ">
                                        <option value="">Select a District</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                                        @endforeach
                                    </select>
                                </p>
                                <p class="form-row form-row form-row-last address-field update_totals_on_change validate-required" id="billing_country_field">
                                    <label for="billing_country" class="">Upazila <abbr class="required" title="required">*</abbr></label>
                                    <select name="upazila" id="upazila" autocomplete="country" class="country_to_state country_select ">
                                        <option value="">Select a City</option>
                                    </select>
                                </p>
                                <p class="form-row form-row form-row-wide address-field validate-required" id="billing_address_1_field">
                                    <label for="billing_address_1" class="">Address <abbr class="required" title="required">*</abbr></label>
                                    <input type="text" class="input-text " name="address" id="billing_address_1" placeholder="Street address" autocomplete="address-line1" value="" />
                                </p>
                            </div>
                            <p class="form-row form-row notes" id="order_comments_field">
                                    <label for="order_comments" class="">Order Notes</label>
                                    <textarea name="note" class="input-text " id="order_comments" placeholder="Notes about your order, e.g. special notes for delivery." rows="2" cols="5"></textarea>
                                </p>
                            </div>
                        </div>
                        <h3 id="order_review_heading">Your order</h3>
                        <div id="order_review" class="woocommerce-checkout-review-order">
                            <table class="shop_table woocommerce-checkout-review-order-table">
                                <tr class="cart-subtotal">
                                    <th>Subtotal</th>
                                    <td><span class="woocommerce-Price-amount amount">BDT {{ $subtotal }}</span>
                                    </td>
                                    <input name="subtotal" type="hidden" value="{{ $subtotal }}">
                                </tr>
                                <tr class="cart-subtotal">
                                    <th>Discount</th>
                                    <td><span class="woocommerce-Price-amount amount">{{ session('discount') }} {{ (session('type')== 1?'%':'BDT') }}</span>
                                    </td>
                                    <input name="discount" type="hidden" value="{{(  session('type') == 1?$subtotal*session('discount')/100:session('discount')  )}}">
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <form action="#">
                                            <p style="font-weight: 700; color:#052840;">Calculate Shipping <i style="padding-top:10px " class="fas fa-arrow-down"></i></p>
                                            <div class="select_option clearfix">
                                                <select name="delivery_charge" id="delivery_shipping" class="niceSelect">
                                                    <option value="0">Select Your Option</option>
                                                    <option value="50">Inside Dhaka</option>
                                                    <option value="100">Outside Dhaka</option>
                                                </select>
                                            </div>
                                            <table class="woocommerce-checkout-review-order-table">
                                                <tr class="shipping">
                                                    <th>Delivery Charge</th>
                                                    <td data-title="Shipping">
                                                        <span><span class="delivery_charge">0</span> BDT</span>
                                                </tr>
                                            </table>
                                        </form>
                                    </td>
                                </tr>
                                <tr class="order-total">
                                    <th>Total</th><td><strong><span class="woocommerce-Price-amount amount">BDT <span id="total_price" class="woocommerce-Price-currencySymbol">{{ (session('type')== 1? $subtotal - ($subtotal*session('discount'))/100 : $subtotal-session('discount')) }}</span></span></strong> </td>

                                    <input name="total_price" type="hidden" id="total_price_input" value="{{ (session('type')== 1? $subtotal - ($subtotal*session('discount'))/100 : $subtotal-session('discount')) }}">
                                </tr>
                            </table>
                            <div id="payment" class="woocommerce-checkout-payment py-3 mt-5">
                            <ul class="wc_payment_methods payment_methods methods">
                                <li class="wc_payment_method payment_method_cheque mb-2">
                                    <input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="1" checked='checked' data-order_button_text="" />
                                    <!--grop add span for radio button style-->
                                    <span class='grop-woo-radio-style'></span>
                                    <!--custom change-->
                                    <label for="payment_method_cheque">Cash On Delivery</label>
                                </li>
                                <li class="wc_payment_method payment_method_paypal mb-2">
                                    <input id="payment_method_ssl" type="radio" class="input-radio" name="payment_method" value="2" data-order_button_text="Proceed to SSL Commerz" />
                                    <!--grop add span for radio button style-->
                                    <span class='grop-woo-radio-style'></span>
                                    <!--custom change-->
                                    <label for="payment_method_ssl">SSL Commerz</label>
                                </li>
                                <li class="wc_payment_method payment_method_paypal">
                                    <input id="payment_method_stripe" type="radio" class="input-radio" name="payment_method" value="3" data-order_button_text="Proceed to SSL Commerz" />
                                    <!--grop add span for radio button style-->
                                    <span class='grop-woo-radio-style'></span>
                                    <!--custom change-->
                                    <label for="payment_method_stripe">Stripe Payment</label>
                                </li>
                            </ul>
                            <div class="form-row place-order">
                                <noscript>
                                    Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.
                                    <br/>
                                </noscript>
                                <input type="submit" class="button alt" id="place_order" value="Place order" data-value="Place order" />
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- checkout-section - end
================================================== -->
@endsection

@section('footer_script')

    <script>

        $(document).ready(function() {
            $('#city_district').select2();
        });

        $(document).ready(function() {
            $('#upazila').select2();
        });

        $('#delivery_shipping').change(function(){
            let delivery_shipping = $('#delivery_shipping').val();
            $('.delivery_charge').html(delivery_shipping);

            let total_price = {{ (session('type')== 1? $subtotal - ($subtotal*session('discount'))/100 : $subtotal-session('discount')) }};
            let total_delivery_price = parseInt(total_price) + parseInt(delivery_shipping);

            $('#total_price').html(total_delivery_price);
            $('#total_price_input').val(total_delivery_price);
        });

        $('#city_district').change(function(){
            let city_id = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url  : '/getcityid',
                type : 'POST',
                data :{'city_id': city_id},
                success: function(data){
                    $('#upazila').html(data);
                }
            });

        });
    </script>

@endsection
