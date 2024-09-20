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
                            <a href="{{ url('permissions/create') }}" class="btn btn-primary float-end text-white"><i class="fa fa-plus"></i> Add Permission</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example2" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                    <tr class="change-text-color">
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            @can('update permission')
                                                <a href="{{ url('permissions/'.$permission->id.'/edit') }}" class="btn btn-warning text-white"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan
                                            @can('delete permission')
                                                <a href="{{ url('permissions/'.$permission->id.'/delete') }}" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
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
    </div>

@endsection
