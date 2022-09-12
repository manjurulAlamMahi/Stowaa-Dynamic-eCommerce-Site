@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        {{-- Todays' Orders --}}
        <div class="col-sm-6">
            <div class="card avtivity-card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <span class="activity-icon bgl-success mr-md-4 mr-3">
                            <i style="font-size: 24px; color:#297F00;" class="fa-solid fa-calendar-day"></i>
                        </span>
                        <div class="media-body">
                            <p class="fs-14 mb-2">Today's Order</p>
                            <span class="title text-black font-w600">{{ $todays_order }}</span>
                        </div>
                    </div>
                    <div class="progress" style="height:5px;">
                        <div class="progress-bar bg-success" style="width: 100%; height:5px;" role="progressbar">
                            <span class="sr-only">{{ $todays_order }}</span>
                        </div>
                    </div>
                </div>
                <div class="effect bg-success"></div>
            </div>
        </div>
        {{-- Total Sale --}}
        <div class="col-sm-6">
            <div class="card avtivity-card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <span class="activity-icon bgl-secondary  mr-md-4 mr-3">
                            <i style="font-size: 24px; color:#A02CFA; line-height:80px;" class="fa-solid fa-hand-holding-dollar"></i>
                        </span>
                        <div class="media-body">
                            <p class="fs-14 mb-2">Total Earn In Previous Month</p>
                            <span class="title text-black font-w600">{{ $total_sell }} BDT</span>
                        </div>
                    </div>
                    <div class="progress" style="height:5px;">
                        <div class="progress-bar bg-secondary" style="width: 100%; height:5px;" role="progressbar">
                            <span class="sr-only">{{ $total_sell }}</span>
                        </div>
                    </div>
                </div>
                <div class="effect bg-secondary"></div>
            </div>
        </div>
        {{-- Weekly Orders --}}
        <div class="col-sm-6">
            <div class="card avtivity-card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <span class="activity-icon bgl-danger mr-md-4 mr-3">
                            <i style="font-size: 24px; color:#F94687;" class="fa-solid fa-calendar-week"></i>
                        </span>
                        <div class="media-body">
                            <p class="fs-14 mb-2">Last 7days Order's</p>
                            <span class="title text-black font-w600">{{ $last_weekl_orders }}</span>
                        </div>
                    </div>
                    <div class="progress" style="height:5px;">
                        <div class="progress-bar bg-danger" style="width: 100%; height:5px;" role="progressbar">
                            <span class="sr-only">{{ $last_weekl_orders }}</span>
                        </div>
                    </div>
                </div>
                <div class="effect bg-danger"></div>
            </div>
        </div>
        {{-- Total Product Sell --}}
        <div class="col-sm-6">
            <div class="card avtivity-card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <span class="activity-icon bgl-warning  mr-md-4 mr-3">
                            <i style="font-size: 24px; color:#ff9900;;" class="fa-solid fa-cart-arrow-down"></i>
                        </span>
                        <div class="media-body">
                            <p class="fs-14 mb-2">Previous Month Total Product Sale</p>
                            <span class="title text-black font-w600">{{ $total_product_sell }}</span>
                        </div>
                    </div>
                    <div class="progress" style="height:5px;">
                        <div class="progress-bar bg-warning" style="width: 100%; height:5px;" role="progressbar">
                            <span class="sr-only">{{ $total_product_sell }}</span>
                        </div>
                    </div>
                </div>
                <div class="effect bg-warning"></div>
            </div>
        </div>
        {{-- Chart Yesterday & Today Sale --}}
        <div class="col-sm-6">
            <canvas id="myChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
const ctx = document.getElementById('myChart');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Yesterday Sale', 'Today Sale'],
        datasets: [{
            label: 'Yesterday Sale',
            data: [{{ $yesterday_total_sale }}, {{ $today_total_sale }}],
            backgroundColor: [
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
@endsection
