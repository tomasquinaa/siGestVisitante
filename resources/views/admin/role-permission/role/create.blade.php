@extends('admin.layout.app')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Role
                            <a href="{{ url('roles') }}" class="btn btn-primary float-end text-white">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('roles') }}" method="POST">
                            @csrf 
                            
                            <div class="mb-3">
                                <label class="change-text-color">Role Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Digite a role">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection