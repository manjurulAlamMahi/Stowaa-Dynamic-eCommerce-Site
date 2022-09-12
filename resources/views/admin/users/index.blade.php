@extends('layouts.dashboard')

@section('content')

<div class="container">

    <div class="card">
        <div class="card-header d-flex">
            <h3 class="" >Users Info</h3>
            <span style="font-size: 14px">Total Users : ({{ $count_users }})</span>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>SL.</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Created at</td>
                        <td>Updated at</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody style="border-top:inherit;">
                    @foreach ($all_users as $key => $user)
                    <tr>
                        <td>{{ $all_users->firstitem()+$key }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->diffForHumans() }}</td>
                        <td>{{ $user->updated_at->diffForHumans() }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                <a href="{{ route('delete_user', $user->id) }}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $all_users->links(); }}
        </div>
    </div>

</div>

@endsection
