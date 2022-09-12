@extends('frontend.master')

@section('content')
<!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="index.html">Home</a></li>
            <li>Product Grid</li>
        </ul>
    </div>
</div>
<!-- breadcrumb_section - end
================================================== -->

<!-- product_section - start
================================================== -->
<section class="product_section section_space">
    <h2 class="hidden">Product sidebar</h2>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <aside class="sidebar_section p-0 mt-0">
                    <div class="sb_widget sb_category">
                        <h3 class="sb_widget_title">Categories</h3>
                        <ul class="sb_category_list ul_li_block">
                            <style>
                                .cate_active{
                                    color: #ffffff !important;
                                    border-color: #f02757 !important;
                                    background-color: #f02757 !important;
                                }
                            </style>
                            <li class="efg">
                                <a
                                style="cursor: pointer"
                                class="category_id{{ ( isset($_GET['c']) && !empty($_GET['c']) && $_GET['c'] != "" && $_GET['c'] != "undefined"?'':' cate_active') }}"
                                data-cID="">All Category
                                <span>({{ App\Models\product::all()->count() }})</span>
                                </a>
                            </li>
                            @foreach ($categories as $category)
                            <li class="efg">
                                <a
                                style="cursor: pointer"
                                class="category_id{{ (isset($_GET['c']) && $_GET['c'] == $category->id?' cate_active':'') }}"
                                data-cID="{{ $category->id }}">{{ $category->category_name }}
                                <span>({{ App\Models\product::where('category_id',$category->id )->count() }})</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="sb_widget">
                        <h3 class="sb_widget_title">Your Filter</h3>
                        <div class="filter_sidebar">
                            @if (isset($_GET['c']))
                                @if (!empty($_GET['c']) && $_GET['c'] != '' && $_GET['c'] != "undefined")
                                    <div class="fs_widget">
                                        <h3 class="fs_widget_title">Sub Category</h3>
                                        <div class="select_option clearfix">
                                            <select id="subcategory_id" class="form-control nice-select niceSelect">
                                                <option value="" selected>Select SubCategory</option>
                                                @foreach (App\Models\subcategory::where('category_id',$_GET['c'])->get() as $subcate)
                                                    <option
                                                    @if (isset($_GET['sc']))
                                                        @if ($_GET['sc'] == $subcate->id)
                                                            Selected
                                                        @endif
                                                    @endif
                                                    value="{{ $subcate->id }}">{{ $subcate->subcategory_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            <div class="fs_widget">
                                <h3 class="fs_widget_title">Price Range:</h3>

                                <label for="min-price" class="form-label">Min price: </label>
                                <span id="min-price-txt">
                                    {{ (isset($_GET['min'])?$_GET['min']:"0") }} BDT
                                </span>
                                <input type="range" class="form-range" min="0" max="5000" id="min-price"  step="1"
                                value="{{ (isset($_GET['min'])?$_GET['min']:"0") }}"
                                >
                                <label for="max-price" class="form-label">Max price: </label>
                                <span id="max-price-txt">
                                    {{ (isset($_GET['max'])?$_GET['max']:"5001") }} BDT
                                </span>
                                <input type="range" class="form-range" min="5001" max="1000000" id="max-price" step="1" value="{{ (isset($_GET['max'])?$_GET['max']:"1000000") }}">

                                <button id="price_search" style="width:100%; margin-top:10px;" class="btn btn-primary">Search</button>
                            </div>

                            <div class="fs_widget">
                                <h3 class="fs_widget_title">Color</h3>
                                <form action="#">
                                    <ul class="fs_brand_list ul_li_block">
                                        <li>
                                            <div class="checkbox_item">
                                                <input value="" class="color_id" type="radio" name="brand_checkbox" checked />
                                                <label for="color_id">All Color</label>
                                            </div>
                                        </li>
                                        @foreach ($colors as $color)
                                            @if ($color->color_name != "N/A")
                                                <li>
                                                    <div class="checkbox_item">
                                                        <input value="{{ $color->id }}" class="color_id" type="radio" name="brand_checkbox" {{ ( isset($_GET['clr']) && $_GET['clr'] == $color->id ?'checked':'') }} />
                                                        <label for="color_id">{{ $color->color_name }}</label>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </form>
                            </div>

                            <div class="fs_widget">
                                <h3 class="fs_widget_title">Size</h3>
                                <form action="#">
                                    <ul class="fs_brand_list ul_li_block">
                                        <li>
                                            <div class="checkbox_item">
                                                <input value="" class="size_id" type="radio" name="brand_checkbox" checked />
                                                <label for="size_id">All Size</label>
                                            </div>
                                        </li>
                                        @foreach ($sizes as $size)
                                        @if ($size->size_name != "N/A")
                                        <li>
                                            <div class="checkbox_item">
                                                <input value="{{ $size->id }}" class="size_id" type="radio" name="brand_checkbox" {{ ( isset($_GET['sz']) && $_GET['sz'] == $size->id ?'checked':'') }} />
                                                <label for="size_id">{{ $size->size_name }}</label>
                                            </div>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </form>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>

            <style>
                .pagination_wrap nav .pagination{
                    margin: -3px;
                    list-style: none;
                    overflow: hidden;
                    padding-left: 0;
                }
                .pagination_wrap nav .pagination .page-item{
                    padding: 3px;
                    float: left;
                }
                .pagination_wrap nav .pagination .page-item .page-link{
                    min-width: 40px;
                    height: 40px;
                    display: -webkit-box;
                    display: -ms-flexbox;
                    display: flex;
                    font-size: 14px;
                    border-radius: 0;
                    -webkit-box-align: center;
                    -ms-flex-align: center;
                    align-items: center;
                    color: #252525;
                    -webkit-box-pack: center;
                    -ms-flex-pack: center;
                    justify-content: center;
                    border: 1px solid #eeeeee;
                    font-weight: 500;
                }
                .pagination_wrap nav .pagination .page-item.active .page-link{
                    color: #ffffff;
                    border-color: #252525;
                    background-color: #252525;
                }
            </style>

            <div class="col-lg-9">
                <div class="filter_topbar">
                    <div class="row align-items-center">
                        <div class="col col-md-4">
                            <ul class="layout_btns nav" role="tablist">
                                <li>
                                    <button class="active" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><i class="fal fa-bars"></i></button>
                                </li>
                                <li>
                                    <button data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                        <i class="fal fa-th-large"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <div class="col col-md-4">
                            <form action="#">
                                <div style="width: 235px;" class="select_option clearfix">
                                    <select id="sort_by" class="niceSelect">
                                        <option data-display=
                                        "
                                        @if (isset($_GET['sb']))
                                            @if ($_GET['sb'] == "A_Z")
                                                Sorting By Name (A-Z)
                                            @elseif ($_GET['sb'] == "Z_A")
                                                Sorting By Name (Z-A)
                                            @elseif ($_GET['sb'] == "L_H")
                                                Sorting By Price (Low-High)
                                            @elseif ($_GET['sb'] == "H_L")
                                                Sorting By Price (High-Low)
                                            @else
                                                Default Sorting
                                            @endif
                                        @else
                                            Default Sorting
                                        @endif
                                        "
                                        >Select Your Option</option>
                                        <option value="A_Z">Sorting By Name (A-Z)</option>
                                        <option value="Z_A">Sorting By Name (Z-A)</option>
                                        <option value="L_H">Sorting By Price (Low-High)</option>
                                        <option value="H_L">Sorting By Price (High-Low)</option>
                                    </select>
                                </div>
                            </form>
                        </div>

                        <div class="col col-md-4">
                            <div class="result_text">Showing 1-9 of {{ $all_products->count() }} relults</div>
                        </div>
                    </div>
                </div>

                <hr />

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="home" role="tabpanel">
                        @if ($all_products->count() > 0)
                        <div class="shop-product-area shop-product-area-col">
                            <div class="product-area shop-grid-product-area clearfix">
                                @foreach ($all_products as $product)
                                    @if (App\Models\inventory::where('product_id' , $product->id)->exists())
                                    <div class="grid" style="height: 470px;">
                                        <div class="product-pic">
                                            <img src="{{ asset('uploads/products/previews') }}/{{ $product->product_preview }}" alt />
                                            @if ($product->product_discount)
                                                <span class="theme-badge">{{ $product->product_discount }}% OFF</span>
                                            @endif
                                            <div class="actions">
                                                <ul>
                                                    <li>
                                                        <a href="#">
                                                            <svg
                                                                role="img"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                width="48px"
                                                                height="48px"
                                                                viewBox="0 0 24 24"
                                                                stroke="#2329D6"
                                                                stroke-width="1"
                                                                stroke-linecap="square"
                                                                stroke-linejoin="miter"
                                                                fill="none"
                                                                color="#2329D6"
                                                            >
                                                                <title>Favourite</title>
                                                                <path
                                                                    d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"
                                                                />
                                                            </svg>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <svg
                                                                role="img"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                width="48px"
                                                                height="48px"
                                                                viewBox="0 0 24 24"
                                                                stroke="#2329D6"
                                                                stroke-width="1"
                                                                stroke-linecap="square"
                                                                stroke-linejoin="miter"
                                                                fill="none"
                                                                color="#2329D6"
                                                            >
                                                                <title>Shuffle</title>
                                                                <path d="M21 16.0399H17.7707C15.8164 16.0399 13.9845 14.9697 12.8611 13.1716L10.7973 9.86831C9.67384 8.07022 7.84196 7 5.88762 7L3 7" />
                                                                <path d="M21 7H17.7707C15.8164 7 13.9845 8.18388 12.8611 10.1729L10.7973 13.8271C9.67384 15.8161 7.84196 17 5.88762 17L3 17" />
                                                                <path d="M19 4L22 7L19 10" />
                                                                <path d="M19 13L22 16L19 19" />
                                                            </svg>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="quickview_btn" data-bs-toggle="modal" href="#quickview_popup" role="button" tabindex="0">
                                                            <svg
                                                                width="48px"
                                                                height="48px"
                                                                viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                stroke="#2329D6"
                                                                stroke-width="1"
                                                                stroke-linecap="square"
                                                                stroke-linejoin="miter"
                                                                fill="none"
                                                                color="#2329D6"
                                                            >
                                                                <title>Visible (eye)</title>
                                                                <path d="M22 12C22 12 19 18 12 18C5 18 2 12 2 12C2 12 5 6 12 6C19 6 22 12 22 12Z" />
                                                                <circle cx="12" cy="12" r="3" />
                                                            </svg>
                                                        </a>
                                                    </li>
                                                </ul>
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
                                        <div class="details">
                                            <h4><a href="{{ route('product_details',$product->slug) }}">{{ $product->product_name }}</a></h4>
                                            <p><a href="{{ route('product_details',$product->slug) }}">{{ substr("$product->short_desp", 0 , 80) }}...</a></p>
                                            <div class="rating">
                                                @for ($i=1; $i <= $avrg; $i++)
                                                    <i class="fas fa-star"></i>
                                                @endfor
                                            </div>
                                            <span class="price">
                                                <ins>
                                                    <span class="woocommerce-Price-amount amount">
                                                        <bdi> <span class="woocommerce-Price-currencySymbol">BDT</span>{{ $product->discount_price }}</bdi>
                                                    </span>
                                                </ins>
                                                @if ($product->product_discount)
                                                <del aria-hidden="true">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <bdi> <span class="woocommerce-Price-currencySymbol">BDT</span>{{ $product->product_price }} </bdi>
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
                            </div>
                        </div>

                        <div class="pagination_wrap">
                            {{ $all_products->links(); }}
                        </div>
                        @else
                        <!-- empty_cart_section - start
                        ================================================== -->
                        <section class="empty_cart_section section_space">
                            <div class="container">
                                <div class="empty_cart_content text-center">
                                    <span class="cart_icon">
                                        <i class="icon icon-ShoppingCart"></i>
                                    </span>
                                    <h3>There are no result/product found !!</h3>
                                </div>
                            </div>
                        </section>
                        <!-- empty_cart_section - end
                        ================================================== -->
                        @endif
                    </div>

                    <div class="tab-pane fade" id="profile" role="tabpanel">
                        <div class="product_layout2_wrap">
                            <div class="product-area-row">
                                @foreach ($all_products_list as $product)
                                    @if (App\Models\inventory::where('product_id' , $product->id)->exists())
                                        <div class="grid clearfix">
                                            <div class="product-pic">
                                                <img src="{{ asset('uploads/products/previews') }}/{{ $product->product_preview }}" alt />
                                                @if ($product->product_discount)
                                                    <span class="theme-badge-2">{{ $product->product_discount }}% OFF</span>
                                                @endif
                                                <div class="actions">
                                                    <ul>
                                                        <li>
                                                            <a href="{{ route('favourit', $product->id) }}">
                                                                <svg
                                                                    role="img"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    width="48px"
                                                                    height="48px"
                                                                    viewBox="0 0 24 24"
                                                                    stroke="#2329D6"
                                                                    stroke-width="1"
                                                                    stroke-linecap="square"
                                                                    stroke-linejoin="miter"
                                                                    fill="none"
                                                                    color="#2329D6"
                                                                >
                                                                    <title>Favourite</title>
                                                                    <path
                                                                        d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"
                                                                    />
                                                                </svg>
                                                            </a>
                                                        </li>
                                                    </ul>
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
                                            <div class="details">
                                                <h4><a href="{{ route('product_details',$product->slug) }}">{{ $product->product_name }}</a></h4>
                                                <p><a href="{{ route('product_details',$product->slug) }}">{{ $product->short_desp }}</a></p>
                                                <div class="rating">
                                                    @for ($i=1; $i <= $avrg; $i++)
                                                        <i class="fas fa-star"></i>
                                                    @endfor
                                                </div>
                                                <span class="price">
                                                    <ins>
                                                        <span class="woocommerce-Price-amount amount">
                                                            <bdi> <span class="woocommerce-Price-currencySymbol">BDT</span>{{ $product->discount_price }} </bdi>
                                                        </span>
                                                    </ins>
                                                    @if ($product->product_discount)
                                                    <del aria-hidden="true">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <bdi> <span class="woocommerce-Price-currencySymbol">BDT</span>{{ $product->product_price }} </bdi>
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
                            </div>
                        </div>

                        <div class="pagination_wrap">
                            {{ $all_products_list->links(); }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product_section - end
================================================== -->
@endsection

@section('footer_script')

<script>
    let list = document.querySelectorAll(".efg");

    let list_arr = Array.from(list);

    list_arr.map(item=>{
        item.addEventListener('click', function(e){

            if(e.target.className == 'category_id'){
                let category_id = e.target.dataset.cid
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

    $('.size_id').click(function(c){
        let search_input = $('#search_input').val();
        let search_category = $('#search_category').val();
        let search_subcategory = $('#subcategory_id').val();
        let min_price = 0;
        let max_price = 1000000;
        let sort_by = $('#sort_by').val();
        let size = $('input[class="size_id"]:checked').val();
        let color = $('input[class="color_id"]:checked').val();
        let url = "{{ route('shop') }}?"+"q="+search_input+"&c="+search_category+"&sc="+search_subcategory+"&sz="+size+"&clr="+color+"&min="+min_price+"&max="+max_price+"&sb="+sort_by;
        window.location.href = url;
    })
    $('.color_id').click(function(c){
        let search_input = $('#search_input').val();
        let search_category = $('#search_category').val();
        let search_subcategory = $('#subcategory_id').val();
        let min_price = 0;
        let max_price = 1000000;
        let sort_by = $('#sort_by').val();
        let size = $('input[class="size_id"]:checked').val();
        let color = $('input[class="color_id"]:checked').val();
        let url = "{{ route('shop') }}?"+"q="+search_input+"&c="+search_category+"&sc="+search_subcategory+"&sz="+size+"&clr="+color+"&min="+min_price+"&max="+max_price+"&sb="+sort_by;
        window.location.href = url;
    })
    $('#price_search').click(function(c){
        let search_input = $('#search_input').val();
        let search_category = $('#search_category').val();
        let search_subcategory = $('#subcategory_id').val();
        let min_price = $('#min-price').val();
        let max_price = $('#max-price').val();
        let sort_by = $('#sort_by').val();
        let size = $('input[id="size_id"]:checked').val();
        let color = $('input[id="color_id"]:checked').val();
        let url = "{{ route('shop') }}?"+"q="+search_input+"&c="+search_category+"&sc="+search_subcategory+"&sz="+size+"&clr="+color+"&min="+min_price+"&max="+max_price+"&sb="+sort_by;
        window.location.href = url;
    })
    $('#subcategory_id').change(function(c){
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
    $('#sort_by').change(function(c){
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

    let min_price = 0;
    let max_price = 5001;

    $(document).ready(function () {
        showAllItems(); //Display all items with no filter applied
    });

    $("#min-price").on("change mousemove", function () {
        min_price = parseInt($("#min-price").val());
        $("#min-price-txt").text(min_price + " BDT");
        showItemsFiltered();
    });

    $("#max-price").on("change mousemove", function () {
        max_price = parseInt($("#max-price").val());
        $("#max-price-txt").text(max_price + " BDT");
        showItemsFiltered();
    });


</script>

@endsection
