@extends('layouts.dashboard')

@section('content')
    <div class="container mb-3">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="card">
                    <form action="{{ route('subcategory.store') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4>Add SubCategory</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <select name="category_id" id="" class="form-control">
                                    <option class="form-control" value="">-- Select Category --</option>
                                    @foreach ($category_name as $categories)
                                        <option class="form-control" value="{{ $categories->id }}">{{ $categories->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-1">
                                <label for="" class="form-label">Subcategory Name</label>
                                <input class="form-control" type="text" name="subcategory_name">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info text-white">ADD SUBCATEGORY</button>
                            @if (session('error'))
                                <strong class="text-danger mt-3">{{ session('error') }}</strong>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Sub Category List
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>SL.</th>
                                <th>Category Name</th>
                                <th>Sub Category Name</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($subcategories as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->rel_to_category->category_name }}</td>
                                <td>{{ $item->subcategory_name }}</td>
                                <td>
                                    <a href="" class="btn btn-info text-white">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
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
        </div>
    </div>
@endsection
