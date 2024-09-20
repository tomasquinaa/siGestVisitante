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
                        <h4>
                            <a href="{{ url('roles/create') }}" class="btn btn-primary float-end text-white"><i class="fa fa-plus"></i> Add Role</a>
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
                                @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <a href="{{ url('roles/'.$role->id.'/give-permissions') }}" class="btn btn-success text-white"><i class="fa fa-plus"></i> Add / Edit Role Permission</a>
                                        {{-- @can('update role') --}}
                                        @role('Super')
                                            <a href="{{ url('roles/'.$role->id.'/edit') }}" class="btn btn-success text-white"><i class="fa fa-edit"></i> Edit</a>
                                        @endrole
                                            {{-- @endcan --}}
                                        @can('delete role')
                                            <a href="{{ url('roles/'.$role->id.'/delete') }}" class="btn btn-danger text-white"><i class="fa fa-trash"></i> Delete</a>
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
