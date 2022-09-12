@extends('layouts.dashboard')

@section('content')

    <style>
        #products .note-editor .panel-heading
        {
            background: #fff;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="products" class="card text-white bg-dark">
                    <form action="{{ route('insert_product') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            Add Product Item
                            @error('category_name')
                                <strong class="text-danger d-block mt-2">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="card-body">
                            <div class="row">
                                {{-- SELECT CATEGORY START --}}
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Select Category</label>
                                        <select name="category_name" id="category_list" class="form-control default-select">
                                            <div class="dropdown bootstrap-select form-control default-select dropup">
                                                <option class="dropdown-item" value="">-- Select Category --</option>
                                                @foreach ($categories as $category)
                                                    <option class="dropdown-item" value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                @endforeach
                                            </div>
                                        </select>
                                    </div>
                                </div>{{-- SELECT CATEGORY END --}}
                                {{-- SELECT SUB-CATEGORY START --}}
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Select Sub Category</label>
                                        <select name="subcategory_name" id="subcategory_list" class="form-control">
                                            <div class="dropdown bootstrap-select form-control default-select dropup">
                                                <option class="dropdown-item" value="">-- Select Sub-Category --</option>
                                                @foreach ($subcategories as $subcategory)
                                                    <option class="dropdown-item" value="">{{ $subcategory->subcategory_name }}</option>
                                                @endforeach
                                            </div>
                                        </select>
                                    </div>
                                </div>{{-- SELECT SUB-CATEGORY END --}}
                                {{-- SELECT PRODUCT NAME START --}}
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Product Name</label>
                                        <input type="text" class="form-control" placeholder="NAME" name="product_name">
                                    </div>
                                </div>{{-- SELECT PRODUCT NAME START --}}
                                {{-- SELECT PRODUCT PRICE START --}}
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Product Price</label>
                                        <input id="product_price" name="product_price" type="text" class="form-control" placeholder="BDT" value="">
                                    </div>
                                </div>{{-- SELECT PRODUCT PRICE END --}}
                                {{-- SELECT PRODUCT DISCOUNT START --}}
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Product Discount</label>
                                        <input id="product_discount" name="product_discount" type="text" class="form-control" placeholder="%" value="">
                                    </div>
                                </div>{{-- SELECT PRODUCT DISCOUNT END --}}
                                {{-- SELECT PRODUCT AFTER DISCOUNT START --}}
                                <div class="col-lg-3">
                                    <div class="mb-3" id="discount_price">
                                        <label for="" class="form-label">After Discount Price</label>
                                        <input readonly id="after_discount_price" type="text" class="form-control" value="">
                                    </div>
                                </div>{{-- SELECT PRODUCT AFTER DISCOUNT START --}}
                                {{-- SHORT DESCRIPTION --}}
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Short Description</label>
                                        <textarea placeholder="Description must be in 100 words" style="resize: none" class="form-control" name="short_desp" id="" cols="5" rows="2"></textarea>
                                    </div>
                                </div>{{-- SHORT DESCRIPTION --}}
                                {{-- LONG DESCRIPTION --}}
                                <div class="col-lg-12" style="background: transparent">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Long Description</label>
                                        <textarea name="long_desp" id="summernote"></textarea>
                                    </div>
                                </div>{{-- LONG DESCRIPTION --}}
                                {{-- PREVIEW IMAGE --}}
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Product Preview</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                            <div class="custom-file">
                                                <input name="product_preview" type="file" class="custom-file-input">
                                                <label class="custom-file-label">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- THUMBNAILS IMAGE --}}
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Product Thumbnails</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                            <div class="custom-file">
                                                <input multiple type="file" class="custom-file-input" name="thumbnails[]">
                                                <label class="custom-file-label">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">ADD PRODUCT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')

    <script>
        $('#category_list').change(function(){
            var category_id = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type : 'POST',
                url  : '/getsubcategory',
                data :{'category_id':category_id},
                success: function(data){
                    $('#subcategory_list').html(data);
                }
            });

        });
    </script>

    <script>
        $('#product_price').on('keyup', function(){
            calculatePrice();
        });

        $('#product_discount').on('keyup', function(){
            calculatePrice();
        });

        function calculatePrice(){
            var price = $('#product_price').val();
            var discount = $('#product_discount').val();
            var after_discount_price = price - (price * discount/100);

            if(price != '' && discount != ''){
                $('#after_discount_price').val(Math.round(after_discount_price));
            }
            else{
                $('#after_discount_price').val('No Discount');
            }
        }
    </script>

@endsection
