@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <form action="{{ route('update.category') }}" method="POST" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Category</h4>
                        </div>
                        <div class="card-body">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Category Name</label>
                                <input type="hidden" name="category_id" value="{{ $prv_category->id }}">
                                <input type="text" class="form-control" name="category_name" value="{{ $prv_category->category_name }}">
                                @error('category_name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Category Image</label>
                                <input type="file" name="category_img" class="form-control" oninput="pic.src=window.URL.createObjectURL(this.files[0])">
                            </div>
                            <img width="100" src="{{ asset('uploads/category') }}/{{ $prv_category->category_img }}" alt="{{ $prv_category->category_img }}" id="pic">
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                Updated Category
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

