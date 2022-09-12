@extends('layouts.dashboard')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-white card-title">ADD COUPON</h3>
                </div>
                <form action="{{ route('coupon_store') }}" method="POST">
                    @csrf
                    <div class="card-body row">
                        <div class="form-group col-lg-6">
                            <label class="form-label" for="">Coupon Name*</label>
                            <input class="form-control" name="coupon_name" type="text">
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="form-label" for="">Coupon Type*</label>
                            <select name="coupon_type" class="form-control">
                                <option>-- Select Coupon Type --</option>
                                <option value="1">Percentage</option>
                                <option value="2">Fixed Amount</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="form-label" for="">Coupon Amount/Percentage*</label>
                            <input class="form-control" name="discount" type="text">
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="form-label" for="">Coupon Validity*</label>
                            <input class="form-control" name="validity" type="date">
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="form-label" for="">Coupon Capacity*</label>
                            <input class="form-control" name="minimum_price" type="text" placeholder="minimum order price">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Add Coupon</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
