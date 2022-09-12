@extends('layouts.dashboard')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Profile</h4>
                </div>
                <form action="{{ route('update_user') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        @if ($edit_type == "name")
                            <div class="form-group">
                                <label for="" class="form-label">Old Name</label>
                                <input readonly type="text" class="form-control" value="{{ Auth::user()->name }}">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">New Name*</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                        @elseif ($edit_type == "email")
                            <div class="form-group">
                                <label for="" class="form-label">Old Email</label>
                                <input readonly type="text" class="form-control" value="{{ Auth::user()->email }}">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">New Email*</label>
                                <input type="text" class="form-control" name="email">
                            </div>
                        @else
                            <div class="form-group">
                                <label for="" class="form-label">Old Profile Photo</label>
                                <div class="pp" style="width:100px; height:100px; border-radius:50%; ">
                                    <img class="w-100 image-fluid" src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">New Profile Photo*</label>
                                <input type="file" class="form-control" name="profile_photo">
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="" class="form-label">Password*</label>
                            <input type="password" class="form-control" name="password">
                            <input type="hidden" class="form-control" name="user_id" value="{{ Auth::id(); }}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">UPDATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
