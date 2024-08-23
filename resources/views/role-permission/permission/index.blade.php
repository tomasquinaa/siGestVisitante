@extends('layout.app')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                @if(session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endsession

                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Permissions
                            <a href="{{ url('permissions/create') }}" class="btn btn-primary float-end">Add Permission</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>Id</tr>
                                <tr>Name</tr>
                                <tr>Action</tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        @can('update permission')
                                            <a href="{{ url('permissions/'.$permission->id.'/edit') }}" class="btn btn-success">Edit</a>
                                        @endcan
                                        @can('delete permission')
                                            <a href="{{ url('permissions/'.$permission->id.'/delete') }}" class="btn btn-danger">Delete</a>
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
