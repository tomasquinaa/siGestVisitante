@extends('admin.layout.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Cadastrar Departamento</h4>
        </div>
        <div class="card-body">
            <div class="basic-form">
                <form id="visitForm" action="{{ route('departament.store')}}" method="POST">
                    @csrf 

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="change-text-color">Nome Departamento</label>
                            <input type="text" name="name" class="form-control"
                                placeholder="Departamento">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
