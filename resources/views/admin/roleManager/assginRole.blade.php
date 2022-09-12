@extends('layouts.dashboard')

@section('content')

<style>
    .assgin_menu .assgin_menu_item{
        width: 49%;
    }
    .assgin_menu .assgin_menu_item:nth-child(2){
        margin-left: 20px;
    }
    .assgin_menu .assgin_menu_item button{
        width: 100%;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <ul class="assgin_menu nav register_tabnav d-flex my-5" role="tablist">
                <li class="assgin_menu_item" role="presentation">
                    <button class="active btn btn-outline-primary" data-bs-toggle="tab" data-bs-target="#signin_tab" type="button" role="tab" aria-controls="signin_tab" aria-selected="true">ASSGIN ROLE</button>
                </li>
                <li class="assgin_menu_item" role="presentation">
                    <button class="btn light btn-outline-info" data-bs-toggle="tab" data-bs-target="#signup_tab" type="button" role="tab" aria-controls="signup_tab" aria-selected="false">USER ROLE LIST</button>
                </li>
            </ul>
            <div class="register_wrap tab-content">
                <div class="tab-pane fade show active" id="signin_tab" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3>ASSGIN ROLE TO USERS</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table primary-table-bg-hover">
                                        <thead>
                                            <th>SL.</th>
                                            <th>User Name</th>
                                            <th>Email</th>
                                            <th>Current Role</th>
                                            <th>Assgin Role</th>
                                            <th>Action</th>
                                        </thead>
                                        @foreach ($users as $key => $user)
                                            <tbody>
                                                <td>{{ $users->firstitem()+$key }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if (count($user->getRoleNames()) > 0)
                                                        @foreach ($user->getRoleNames() as $role_name)
                                                            {{ $role_name }}
                                                        @endforeach
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                @if (!count($user->getRoleNames()) > 0)
                                                <td>
                                                    <form action="{{ route('assgin_role_store') }}" method="POST">
                                                    @csrf
                                                    <select class="form-control default-select" name="role_id">
                                                        <option value="">-- Select Role --</option>
                                                        @foreach ($role as $role_name)
                                                            <option value="{{ $role_name->id }}">{{ $role_name->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                </td>
                                                <td>
                                                    <button type="submit" class="btn light btn-primary">ASSGIN</button>
                                                    </form>
                                                </td>
                                                @else
                                                <td>
                                                    ---
                                                </td>
                                                <td>
                                                    ---
                                                </td>
                                                @endif
                                            </tbody>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="card-footer">
                                    {{ $users->links(); }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="signup_tab" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h3>USER LIST OF ROLE</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>User Information</th>
                                        <th>Permission's</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $all_users)
                                        @if (count($all_users->getRoleNames()) > 0)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>
                                                    Name : <strong class="text-info">{{ $all_users->name }}</strong><br>
                                                    <strong class="text-info">{{ $all_users->email }}</strong><br>
                                                    Role : @foreach ($all_users->getRoleNames() as $item)
                                                                <strong class="text-primary">{{ $item }}</strong>
                                                            @endforeach
                                                </td>
                                                <td>@foreach ($all_users->getAllPermissions() as $item)
                                                    {{ $item->name }} ||
                                                @endforeach</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                                        <a href="{{ route('delete_user', $user->id) }}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
