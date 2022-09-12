@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="" >Categories List</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('delete.marked.category') }}" method="POST">
                        @csrf
                        <table class="table table-bordered">
                            <tr>
                                <td><label for="mark_all" class="form-label">Mark All</label><input id="click_all" id="mark_all" type="checkbox" class="ms-1"></td>
                                <td>SL.</td>
                                <td>Category Name</td>
                                <td>Category Image</td>
                                <td>Category Icon</td>
                                <td>Added/<span class="d-block">Updated By</span></td>
                                <td>Updated at</td>
                                <td>Action</td>
                            </tr>
                            @forelse ($category_list as $key => $category)
                            <tr>
                                <td><input type="checkbox" name="mark[]" value="{{ $category->id }}"></td>
                                <td>{{ $key+1 }}</td>
                                <td class="align-middle text-center" ><img width="50" src="{{ asset('/uploads/category') }}/{{ $category->category_img }}" alt="{{ $category->category_img }}"></td>
                                <td>{{ $category->category_name }}</td>
                                <td><i class="{{ $category->category_icon }}"></i></td>
                                <td>{{ $category->rel_to_user->name }}</td>
                                <td>{{ $category->updated_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('category.edit', $category->id) }}" class="btn btn-info text-white">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href={{ route('category.delete', $category->id) }}"" class="btn btn-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No Data Found</td>
                            </tr>
                            @endforelse
                        </table>
                        @if ($category_list_count > 0)

                            <button type="submit" class="btn btn-danger">Delete Marked</button>

                        @endif
                        @error("mark")
                            <strong class="text-danger d-block mt-2">{{ $message }}</strong>
                        @enderror
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="" >Trashed Categories List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>SL.</td>
                            <td>Category Name</td>
                            <td>Added/Updated By</td>
                            <td>Created at</td>
                            <td>Deleted at</td>
                            <td>Action</td>
                        </tr>
                        @forelse ($trash_category_list as $key => $category)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>{{ $category->rel_to_user->name }}</td>
                            <td>{{ $category->created_at->diffForHumans() }}</td>
                            <td>{{ $category->deleted_at->diffForHumans() }}</td>
                            <td>
                                <a href="{{ route('category.restore', $category->id) }}" class="btn btn-success text-white">
                                    <i class="fa-solid fa-trash-arrow-up"></i>
                                </a>
                                <a href={{ route('category.per.del', $category->id) }}"" class="btn btn-danger">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No Data Found</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

