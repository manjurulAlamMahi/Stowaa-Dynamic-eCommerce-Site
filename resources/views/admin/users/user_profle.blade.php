@extends('layouts.dashboard')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-4 m-auto">
            <style>
                .profile_picture{
                    width: 150px;
                    height:150px;
                    border-radius:50%;
                    position: relative;
                }
                .profile_picture::after{
                    position: absolute;
                    content: "";
                    top: 0px;
                    left: 0px;
                    width: 151px;
                    height: 151px;
                    border-radius: 50%;
                    border: 5px solid;
                    border-color: #fff;
                }
                .profile_picture .ovrly{
                    position: absolute;
                    top: 3px;
                    left: 3px;
                    width: 145px;
                    height: 145px;
                    border-radius: 50%;
                    background: rgba(0, 0, 0, 0.6);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    z-index: 999;
                    transform: scale(0);
                    transition: all linear .3s;
                }
                .profile_picture:hover .ovrly{
                    transform: scale(1);
                }
                .profile_picture .ovrly a{
                    color: #fff !important;
                }
                .profile_picture .ovrly a:hover{
                    text-decoration: underline;
                }
            </style>
            <div class="profile_picture m-auto">
                <img class="w-100 image-fluid" src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" />
                <div class="ovrly">
                    <a href="{{ route('edit_user_photo', 'profile-photo') }}">Edit Picture</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row m-5">
        <div class="col-lg-6 m-auto">
            <div class="profile_info" style="text-align: center;">
                <ul>
                    <li class="text-primary" style="font-weight:600;">
                        <span style="color:black; font-size:16px; font-weight:700; margin-right:5px;">Name :</span>
                        {{ Auth::user()->name }}
                        <a href="{{ route('edit_user_photo', 'name') }}"><i style="margin-left: 5px" class="fa fa-pencil"></i></a>
                    </li>
                    <li class="text-primary" style="font-weight:600;">
                        <span style="color:black; font-size:16px; font-weight:700;">Email :</span>
                        {{ Auth::user()->email }}
                        <a href="{{ route('edit_user_photo', 'email') }}"><i style="margin-left: 5px" class="fa fa-pencil"></i></a>
                    </li>
                    <li class="text-info" style="font-weight:600; margin-top:10px;">
                        <span style="color:black; font-size:16px; font-weight:700; margin-right:5px;">Role :</span>
                        @foreach ( Auth::user()->roles->pluck('name')  as $role_name)
                            {{ $role_name }}
                        @endforeach
                    </li>
                    <li>
                        <span style="color:black; font-size:16px; font-weight:700; margin-right:5px;">Your Permissions </span>
                        @foreach (Auth::user()->getAllPermissions() as $roles)
                            <li>{{ $roles->name }}</li>
                        @endforeach
                    </li>


                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
