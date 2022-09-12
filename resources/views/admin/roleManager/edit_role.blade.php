@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="col-lg-6 m-auto">
        <div class="card">
            <div class="card-header">
                <h3>UPDATE ROLE</h3>
            </div>
            <form action="{{ route('role_update') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="" class="form-label">Role Name</label>
                        <input readonly type="text" class="form-control" value="{{ $role->name }}">
                        <input readonly type="hidden" name="role_id" class="form-control" value="{{ $role->id }}">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Role Access</label>
                        <br>
                        @foreach ($permission as $permissions)
                            <input {{ ($role->hasPermissionTo($permissions->name)?'checked':'') }} type="checkbox" value="{{ $permissions->id }}" name="permission[]"> {{ $permissions->name }}
                            <br>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">UPDATE PERMISSION</button>
                </div>
                </form>
        </div>
    </div>
</div>
@endsection
