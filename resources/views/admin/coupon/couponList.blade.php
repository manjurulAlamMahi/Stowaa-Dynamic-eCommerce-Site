@extends('layouts.dashboard')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Coupon List
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <td>SL.</td>
                            <td>Name</td>
                            <td>Type</td>
                            <td>Amount</td>
                            <td>Validity</td>
                            <td>Min O.Price</td>
                            <td>Status</td>
                            <td>Action</td>
                        </tr>
                        @foreach ($coupons as $key => $coupon)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $coupon->coupon_name }}</td>
                                <td>{{ ($coupon->coupon_type == 1?'Percentage':'Fixed Amount') }}</td>
                                <td>{{ $coupon->coupon_amount }} <span>{{ ($coupon->coupon_type == 1?'%':'BDT') }}</span></td>
                                <td>{{ $coupon->coupon_validity }}</td>
                                <td>{{ $coupon->min_price }} BDT</td>
                                <td>
                                    <a href="{{ route('coupon_status', $coupon->id) }}" class="btn btn-{{($coupon->status == 0?'dark':'warning')}}" ><i class="text-white fa-solid {{($coupon->status == 0?'fa-moon':'fa-sun')}}"></i></a>
                                </td>
                                <td><a href="{{ route('coupon_delete', $coupon->id) }}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
