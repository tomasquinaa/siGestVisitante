@extends('admin.layout.app')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                @if(session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endsession

                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Users
                            <a href="{{ url('users/create') }}" class="btn btn-primary float-end text-white">Add User</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if (!@empty($user->getRoleNames()))
                                           @foreach ($user->getRoleNames() as $rolename)
                                            <label class="badge bg-primary mx-1 text-white">{{ $rolename }}</label>
                                           @endforeach
                                        @endif 
                                    </td>
                                    <td>
                                        @can('update user')
                                            <a href="{{ url('users/'.$user->id.'/edit') }}" class="btn btn-success">Edit</a>
                                        @endcan
                                        @can('delete user')
                                            <a href="{{ url('users/'.$user->id.'/delete') }}" class="btn btn-danger">Delete</a>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                              
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
