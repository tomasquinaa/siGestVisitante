@extends('admin.layout.app')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create user
                            <a href="{{ url('users') }}" class="btn btn-primary float-end text-white">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('users') }}" method="POST">
                            @csrf 
                            
                            <div class="mb-3">
                                <label class="change-text-color">Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="change-text-color">Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="change-text-color">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="change-text-color">Role</label>
                                <select name="roles[]" class="form-control" multiple>
                                    <option value="">Select Role</option>
                                    @foreach($roles as $role)
                                        <option value={{ $role }}>{{ $role }}</option>
                                    @endforeach
                                </select>
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