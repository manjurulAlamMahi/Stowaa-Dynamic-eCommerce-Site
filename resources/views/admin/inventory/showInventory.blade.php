@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <p>Inventory List Of , <b>{{ $products->product_name }}</b></p>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>SL.</th>
                                <th>Color Name</th>
                                <th>Size Name</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($inventories as $key => $inventory)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    @if ($inventory->color_id == 0)
                                        N/A
                                    @else
                                        {{ $inventory->rel_to_color->color_name }}
                                        <div class="align-middle" style="margin:0 3px; width:15px; height:15px; border-radius:50%; background:#{{ $inventory->rel_to_color->color_code }}; display:inline-block;"></div>
                                    @endif
                                </td>
                                <td>
                                    @if ($inventory->size_id == 0)
                                        N/A
                                    @else
                                        {{ $inventory->rel_to_size->size_name }}
                                    @endif
                                </td>
                                <td>{{ $inventory->quantity }}</td>
                                <td>
                                    <a href="" class="btn btn-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        ADD INVENTORY
                    </div>
                    <div class="card-body">
                        <form action="{{ route('add_inentory') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="form-label" for="">Product Name</label>
                                <input type="text" class="form-control" readonly   value="{{ $products->product_name}}">
                                <input type="hidden" class="form-control" name="product_id"  value="{{ $products->id }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="">Select Product Color</label>
                                <select name="color_id" class="form-control">
                                    <option value="">-- Select Color --</option>
                                    @foreach ($colors as $color)
                                        <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="">Select Product Size</label>
                                <br>
                                @foreach ($sizes as $size)
                                <input type="checkbox" class="form-controle" value="{{ $size->id }}" name="size_id[]"> {{ $size->size_name }}
                                <br>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="">Product Quantity</label>
                                <input type="text" class="form-control" name="quantity">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">ADD INVENTORY</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
