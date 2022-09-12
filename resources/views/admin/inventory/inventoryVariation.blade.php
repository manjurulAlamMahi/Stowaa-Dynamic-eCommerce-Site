@extends('layouts.dashboard');

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>COLOR'S</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>SL.</th>
                                <th>Color Name</th>
                                <th>Color Code</th>
                                <th>Color</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($color as $key => $color_item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $color_item->color_name }}</td>
                                    <td>{{ $color_item->color_code }}</td>
                                    <td>
                                        <div style="width:20px; height:20px; border-radius:50%; background:#{{ $color_item->color_code }};"></div>
                                    </td>
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
            <div class="col-lg-4 align-slef-center">
                <div class="card h-auto">
                    <div class="card-header">
                        ADD COLOR
                    </div>
                    <div class="card-body">
                        <form action="{{ route('add_color') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Color Name</label>
                                <input type="text" class="form-control" name="color_name">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Color Code</label>
                                <input type="text" class="form-control" name="color_code">
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit">ADD COLOR</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Size's</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-strip">
                            <tr>
                                <th>SL.</th>
                                <th>Size Name</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($size as $key => $size_item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $size_item->size_name }}</td>
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
                <div class="card h-auto">
                    <div class="card-header">
                        ADD SIZE
                    </div>
                    <div class="card-body">
                        <form action="{{ route('add_size') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Size Name</label>
                                <input type="text" class="form-control" name="size_name">
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit">ADD Size</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
