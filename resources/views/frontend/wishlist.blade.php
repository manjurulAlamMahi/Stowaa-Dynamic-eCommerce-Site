@extends('frontend.master')

@section('content')
<!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="index.html">Home</a></li>
            <li>Wishlist</li>
        </ul>
    </div>
</div>
<!-- breadcrumb_section - end
================================================== -->

<!-- cart_section - start
================================================== -->
<section class="cart_section section_space">
    <div class="container">
        <div class="cart_table">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>PRODUCT</th>
                        <th class="text-center">PRICE</th>
                        <th class="text-center">STOCK STATUS</th>
                        <th class="text-center">ADD TO CART</th>
                        <th class="text-center">REMOVE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wishlists as $favourites)
                    <tr>
                        <td>
                            <div class="cart_product">
                                <img src="{{ asset('uploads/products/previews') }}/{{ $favourites->rel_to_product->product_preview }}" alt="image_not_found" />
                                <h3>{{ $favourites->rel_to_product->product_name }}</h3>
                            </div>
                        </td>

                        <td class="text-center"><span class="price_text">BDT{{ $favourites->rel_to_product->discount_price }}/-</span></td>
                        <td class="text-center">
                            <span class="price_text {{ (App\Models\inventory::where('product_id',$favourites->rel_to_product->id)->exists()?'text-success':'text-danger') }}">
                                {{ (App\Models\inventory::where('product_id',$favourites->rel_to_product->id)->exists()?'In Stock':'Out Stock') }}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('product_details',$favourites->rel_to_product->slug) }}" class="btn btn_primary">Add To Cart</a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('remove_wishes',$favourites->id) }}" class="remove_btn"><i class="fal fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- cart_section - end
================================================== -->
@endsection
