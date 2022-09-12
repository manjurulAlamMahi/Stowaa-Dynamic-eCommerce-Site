@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Roles List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>SL.</th>
                            <th>Role</th>
                            <th>Permission's</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($role as $key => $roles)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $roles->name }}</td>
                                <td>
                                @foreach ($roles->getAllPermissions() as $perm)
                                    -> {{ $perm->name }} <br>
                                @endforeach
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('edit_role',$roles->id) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                        <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card" style="height: auto">
                <div class="card-header">
                    <h3>ADD PERMISSIONS</h3>
                </div>
                <form action="{{ route('permission_store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="" class="form-label">Permission Name</label>
                        <input type="text" class="form-control" name="permission_name">
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">ADD PERMISSION</button>
                </div>
                </form>
            </div>

            <div class="card mt-3" style="height: auto">
                <div class="card-header">
                    <h3>CREATE ROLE's</h3>
                </div>
                <form action="{{ route('role_store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="" class="form-label">Role Name</label>
                        <input type="text" class="form-control" name="role_name">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Role Access</label>
                        <br>
                        @foreach ($permission as $permissions)
                            <input type="checkbox" value="{{ $permissions->id }}" name="permission[]"> {{ $permissions->name }}
                            <br>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">ADD PERMISSION</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
