@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Product List
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL.</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Preview</th>
                            <th>Discount</th>
                            <th>D.Price</th>
                            <th>Description</th>
                            <th>Inventory</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($products as $key => $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->product_price }}</td>
                            <td><img width="60" src="{{ asset('uploads/products/previews') }}/{{ $item->product_preview }}" alt=""></td>
                            <td>{{ $item->product_discount }}% OFF</td>
                            <td>{{ $item->discount_price }}</td>
                            <td>
                                <button class="desp_btn btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample{{ $key }}" aria-expanded="false" aria-controls="collapseExample{{ $key }}">
                                    <i style="font-size: 24px" class="fa-solid fa-circle-chevron-down"></i>
                                </button>
                                <style>
                                    .desp_btn.collapsed i{
                                        transform: rotate(180deg);
                                    }
                                    .desp_btn{
                                        box-shadow: none !important;
                                    }
                                </style>
                            </td>
                            <td>
                                <a class="btn btn-success" href="{{ route('inventory', $item->id) }}"><i class="fa-solid fa-cart-flatbed"></i></a>
                            </td>
                            <td>
                                <a href="" class="btn btn-info text-white">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="" class="btn btn-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr class="collapse" id="collapseExample{{ $key }}">
                            <td colspan="5">
                                <div class="desp">
                                    <div class="title">
                                        <h5 style="color: #333;">Short Description :</h5>
                                    </div>
                                    <div class="content text-center">
                                        <p>{{ $item->short_desp }}</p>
                                    </div>
                                </div>
                            </td>
                            <td colspan="5">
                                <div class="desp">
                                    <div class="title">
                                        <h5 style="color: #333;">Long Description :</h5>
                                    </div>
                                    <div class="content text-center">
                                        <p>{{ $item->long_desp }}</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
